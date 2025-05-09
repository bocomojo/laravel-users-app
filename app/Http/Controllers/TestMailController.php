<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function send()
    {
        Mail::raw('This is a test email from Laravel using Gmail SMTP.', function ($message) {
            $message->to('your_email@gmail.com') // ← Change to your actual email
                    ->subject('Laravel Gmail Test');
        });

        return view('test-email.success');
    }
}

