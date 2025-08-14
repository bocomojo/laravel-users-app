<?php

namespace App\Http\Controllers;

use App\Models\SentMail;

class SentMailController extends Controller
{
    public function index()
    {
        $sentMails = SentMail::latest()->get();
        return view('mail.sent', compact('sentMails'));
    }

    public function show($id)
    {
        $mail = SentMail::findOrFail($id);
        return view('mail.show', compact('mail'));
    }
}
