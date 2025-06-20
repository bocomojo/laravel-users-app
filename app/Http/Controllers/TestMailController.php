<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignedFileMail;
use Illuminate\Support\Facades\Log;

class TestMailController extends Controller
{
    public function send()
    {
        try {
            // Dummy SDO object
            $sdo = (object)[
                'name' => 'Test SDO',
                'email' => 'ingrownmagic@gmail.com'
            ];

            // Dummy file path
            $filename = 'testfile.pdf';
            $filePath = storage_path('app/public/pdfs/testfile.pdf');

            // Make sure the file exists for attachment testing
            if (!file_exists($filePath)) {
                file_put_contents($filePath, 'Dummy PDF content for testing.');
            }

            // Send the test email
            Mail::to($sdo->email)->send(new AssignedFileMail($sdo, $filename, $filePath));

            return '✅ Test email sent to ' . $sdo->email;
        } catch (\Exception $e) {
            Log::error('Test email failed: ' . $e->getMessage());
            return '❌ Test email failed: ' . $e->getMessage();
        }
    }
}
