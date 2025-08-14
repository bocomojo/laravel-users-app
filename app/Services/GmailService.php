<?php

namespace App\Services;

use Google\Client;
use Google\Service\Gmail;

class GmailService
{
    public function getClient()
    {
        $client = new Client();
        $client->setApplicationName('Laravel Gmail API');
        $client->setScopes(Gmail::GMAIL_READONLY);
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = storage_path('app/google/token.json');

        // If no token exists, return null (means no authentication yet)
        if (!file_exists($tokenPath)) {
            return null;
        }

        // Load existing token
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);

        // If token expired, try refresh
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                return null; // Needs re-auth
            }
        }

        return $client;
    }

    public function getSentMessages($maxResults = 20)
    {
        $client = $this->getClient();

        // If no valid client (no token), return null
        if (!$client) {
            return null;
        }

        $service = new Gmail($client);

        $results = $service->users_messages->listUsersMessages('me', [
            'labelIds' => ['SENT'],
            'maxResults' => $maxResults,
        ]);

        $messages = [];
        foreach ($results->getMessages() as $msg) {
            $message = $service->users_messages->get('me', $msg->getId(), [
                'format' => 'metadata',
                'metadataHeaders' => ['To', 'Subject', 'Date']
            ]);

            $headers = collect($message->getPayload()->getHeaders())
                ->pluck('value', 'name');

            $messages[] = [
                'id' => $msg->getId(),
                'to' => $headers['To'] ?? '',
                'subject' => $headers['Subject'] ?? '',
                'date' => $headers['Date'] ?? '',
            ];
        }

        return $messages;
    }
}
