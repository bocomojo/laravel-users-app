<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignedFileMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sdo;
    public $filename;
    public $filePath;

    public function __construct($sdo, $filename, $filePath)
    {
        $this->sdo = $sdo;
        $this->filename = $filename;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject('Assigned File for Your Review')
                    ->view('emails.assigned_file')
                    ->with([
                        'sdoName' => $this->sdo->name,
                        'messageText' => 'Please review the attached file.',
                    ])
                    ->attach($this->filePath, [
                        'as' => $this->filename,
                        'mime' => 'application/pdf',
                    ]);
    }
}
