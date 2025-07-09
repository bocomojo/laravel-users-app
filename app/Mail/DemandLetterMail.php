<?php


namespace App\Mail;

use App\Models\CashAdvance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $advance;

    public function __construct(CashAdvance $advance)
    {
        $this->advance = $advance;
    }

    public function build()
    {
        return $this->subject('Demand Letter for Unliquidated Cash Advance')
            ->markdown('emails.demand.letter');
    }
}
