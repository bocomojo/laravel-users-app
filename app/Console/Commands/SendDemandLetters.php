<?php

namespace App\Console\Commands;

use App\Models\CashAdvance;
use App\Mail\DemandLetterMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class SendDemandLetters extends Command
{
    protected $signature = 'demand:send';
    protected $description = 'Send demand letters for unpaid cash advances 30 days after payout end';

    public function handle(): int
    {
        $now = Carbon::now();

        $cashAdvances = CashAdvance::with(['sdo', 'liquidation'])
            ->whereNotNull('payout_end')
            ->whereNull('demand_letter_sent_at')
            ->get();

        foreach ($cashAdvances as $advance) {
            $end = Carbon::parse($advance->payout_end);

            // 30 days passed and not yet fully liquidated
            if ($now->greaterThanOrEqualTo($end->addDays(30))) {
                $remaining = $advance->granted_amount - $advance->liquidation->sum('liquidated_amount');

                if ($remaining > 0) {
                    // Send the email
                    Mail::to($advance->sdo->email)->send(new DemandLetterMail($advance));

                    // Mark as sent
                    $advance->demand_letter_sent_at = $now;
                    $advance->save();

                    $this->info("Demand letter sent to: " . $advance->sdo->email);
                }
            }
        }

        return Command::SUCCESS;
    }
}

