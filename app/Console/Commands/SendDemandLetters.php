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
            $payoutEnd = Carbon::parse($advance->payout_end);
            $deadline = $payoutEnd->copy()->addDays(30);

            $totalLiquidated = $advance->liquidation->sum('liquidated_amount');
            $remaining = $advance->granted_amount - $totalLiquidated;

            // ✅ Case 1: Fully liquidated before or at deadline — mark safe
            if ($remaining <= 0) {
                $advance->demand_letter_sent_at = $now;
                $advance->save();

                $this->info("Marked as fully liquidated: " . $advance->sdo->name);
                continue;
            }

            // ✅ Case 2: Not yet liquidated AND deadline passed — send demand
            if ($now->greaterThanOrEqualTo($deadline)) {
                Mail::to($advance->sdo->email)->send(new DemandLetterMail($advance));

                $advance->demand_letter_sent_at = $now;
                $advance->save();

                $this->info("Demand letter sent to: " . $advance->sdo->email);
            }
        }

        return Command::SUCCESS;
    }
}
