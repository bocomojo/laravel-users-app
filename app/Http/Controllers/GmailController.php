<?php

namespace App\Http\Controllers;

use App\Services\GmailService;
use App\Models\Sdo;
use Google\Client;
use Google\Service\Gmail;
use Illuminate\Http\Request;

class GmailController extends Controller
{
    protected $gmail;

    public function __construct(GmailService $gmail)
    {
        $this->gmail = $gmail;
    }

    public function auth()
    {
        $client = $this->getGoogleClient();
        $authUrl = $client->createAuthUrl();

        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
    {
        $client = $this->getGoogleClient();
        $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);

        // Save token for later use
        file_put_contents(storage_path('app/google/token.json'), json_encode($accessToken));

        return redirect()->route('gmail.sent')
            ->with('success', 'Gmail connected successfully!');
    }

    public function sent(Request $request)
    {
        $tokenPath = storage_path('app/google/token.json');
        if (!file_exists($tokenPath)) {
            return redirect()->route('gmail.auth')
                ->with('error', 'Please connect your Gmail account to view sent mail.');
        }

        $client = $this->getGoogleClient();
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                if (isset($newToken['error'])) {
                    unlink($tokenPath);
                    return redirect()->route('gmail.auth')
                        ->with('error', 'Gmail session expired, please sign in again.');
                }
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                return redirect()->route('gmail.auth')
                    ->with('error', 'Session expired, please reconnect Gmail.');
            }
        }

        $service = new Gmail($client);
        $subjectFilter = 'Compliance File Submitted';
        $query = 'label:SENT subject:"' . $subjectFilter . '"';

        if ($request->filled('search')) {
            $search = trim($request->search);
            $sdoEmails = Sdo::where('name', 'like', "%{$search}%")->pluck('email')->toArray();

            if (!empty($sdoEmails)) {
                $toQuery = implode(' OR to:', $sdoEmails);
                $query .= ' (to:' . $toQuery . ' OR "' . $search . '")';
            } else {
                $query .= ' "' . $search . '"';
            }
        }

        $params = [
            'q' => $query,
            'maxResults' => 20,
        ];

        if ($request->has('pageToken')) {
            $params['pageToken'] = $request->pageToken;
        }

        $list = $service->users_messages->listUsersMessages('me', $params);
        $messages = [];
        $sdoList = Sdo::pluck('name', 'email')
                    ->mapWithKeys(fn($name, $email) => [strtolower(trim($email)) => $name]);

        foreach ($list->getMessages() as $message) {
            $msg = $service->users_messages->get('me', $message->getId(), ['format' => 'metadata']);
            $headers = collect($msg->getPayload()->getHeaders());

            $toEmails = optional($headers->firstWhere('name', 'To'))->getValue();
            $subject  = optional($headers->firstWhere('name', 'Subject'))->getValue();
            $date     = optional($headers->firstWhere('name', 'Date'))->getValue();

            $toName = '—';
            if (!empty($toEmails)) {
                $emails = explode(',', $toEmails);
                $names = [];
                foreach ($emails as $emailRaw) {
                    if (preg_match('/<(.+)>/', $emailRaw, $matches)) {
                        $email = strtolower(trim($matches[1]));
                    } else {
                        $email = strtolower(trim($emailRaw));
                    }
                    $names[] = $sdoList[$email] ?? $email;
                }
                $toName = implode(', ', $names);
            }

            $messages[] = [
                'id'      => $message->getId(),
                'to'      => $toName,
                'subject' => $subject,
                'date'    => $date,
                'snippet' => $msg->getSnippet(),
            ];
        }

        $nextPageToken = $list->getNextPageToken();

        return view('mail.sent', compact('messages', 'nextPageToken'));
    }

    public function show($id)
    {
        $tokenPath = storage_path('app/google/token.json');
        if (!file_exists($tokenPath)) abort(403, 'Gmail not connected.');

        $client = $this->getGoogleClient();
        $client->setAccessToken(json_decode(file_get_contents($tokenPath), true));

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                if (isset($newToken['error'])) {
                    unlink($tokenPath);
                    abort(403, 'Gmail session expired. Please reconnect.');
                }
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                abort(403, 'Session expired.');
            }
        }

        $service = new Gmail($client);
        $message = $service->users_messages->get('me', $id, ['format' => 'full']);

        $attachments = [];
        $htmlBody = '';

        $processParts = function ($parts) use (&$processParts, $message, &$attachments, &$htmlBody) {
            foreach ($parts as $part) {
                $mimeType = $part->getMimeType();
                $filename = $part->getFilename();
                $body = $part->getBody();

                if ($mimeType === 'text/html' && empty($htmlBody)) {
                    $data = $body->getData() ?? '';
                    $htmlBody = base64_decode(strtr($data, '-_', '+/'));
                }

                if ($filename && $body && $body->getAttachmentId()) {
                    $attachments[] = [
                        'messageId'    => $message->getId(),
                        'attachmentId' => $body->getAttachmentId(),
                        'filename'     => $filename,
                        'mimeType'     => $mimeType
                    ];
                }

                if ($part->getParts()) {
                    $processParts($part->getParts());
                }
            }
        };

        $payload = $message->getPayload();
        $parts = $payload->getParts() ?: [$payload];
        $processParts($parts);

        return response()->json([
            'html'        => $htmlBody ?: '<p>(No Content)</p>',
            'attachments' => $attachments
        ]);
    }

    public function downloadAttachment($messageId, $attachmentId, $filename)
    {
        $tokenPath = storage_path('app/google/token.json');
        if (!file_exists($tokenPath)) {
            return redirect()->route('gmail.auth')
                ->with('error', 'Please connect your Gmail account to download attachments.');
        }

        $client = $this->getGoogleClient();
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                if (isset($newToken['error'])) {
                    unlink($tokenPath);
                    return redirect()->route('gmail.auth')
                        ->with('error', 'Gmail session expired, please sign in again.');
                }
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                return redirect()->route('gmail.auth')
                    ->with('error', 'Please reconnect your Gmail account.');
            }
        }

        $service = new Gmail($client);

        try {
            if (empty($messageId) || empty($attachmentId)) {
                abort(400, 'Invalid attachment request.');
            }

            $filename = preg_replace('/[^\w\-. ]+/', '_', $filename);

            $attachment = $service->users_messages_attachments->get('me', $messageId, $attachmentId);
            $data = base64_decode(strtr($attachment->getData(), ['-' => '+', '_' => '/']));

            if ($data === false) {
                abort(500, 'Failed to decode attachment data.');
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $data) ?: 'application/octet-stream';
            finfo_close($finfo);

            $inlineTypes = [
                'application/pdf',
                'image/jpeg',
                'image/png',
                'image/gif',
                'text/plain'
            ];
            $disposition = in_array($mimeType, $inlineTypes) ? 'inline' : 'attachment';

            return response($data)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', $disposition . '; filename="' . $filename . '"');

        } catch (\Google\Service\Exception $e) {
            abort($e->getCode() ?: 500, 'Gmail API Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            abort(500, 'Server Error: ' . $e->getMessage());
        }
    }

    private function getMessageBody($message)
    {
        $payload = $message->getPayload();
        $body = '';

        if ($payload->getMimeType() === 'text/html' && $payload->getBody()) {
            $body = base64_decode(strtr($payload->getBody()->getData(), '-_', '+/'));
        } elseif ($payload->getParts()) {
            foreach ($payload->getParts() as $part) {
                if ($part->getMimeType() === 'text/html' && $part->getBody()) {
                    $body = base64_decode(strtr($part->getBody()->getData(), '-_', '+/'));
                    break;
                }
            }
        }

        return $body;
    }

    private function getGoogleClient()
    {
        $client = new Client();
        $client->setApplicationName('Laravel Gmail API');
        $client->setScopes(Gmail::GMAIL_READONLY);
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        return $client;
    }
}
