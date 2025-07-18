<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Liquidation;

class ComplianceFileSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $liquidation;
    public $filePath;

    public function __construct(Liquidation $liquidation, $filePath)
    {
        $this->liquidation = $liquidation;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->markdown('emails.compliance.notice')
            ->subject('Compliance File Submitted')
            ->attach(storage_path("app/public/{$this->filePath}"));
    }
}
