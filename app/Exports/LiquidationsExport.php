<?php

namespace App\Exports;

use App\Models\Liquidation;
use App\Models\CashAdvance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class LiquidationsExport implements FromCollection, WithHeadings
{
    protected int|string $cashAdvanceId;

    public function __construct($cashAdvanceId)
    {
        $this->cashAdvanceId = $cashAdvanceId;
    }

    /** Helper to format dates */
    private function d($value): string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : '';
    }

    /** Build all rows */
    public function collection(): Collection
    {
        // Eager‑load SDO and PAP name (via papData relationship)
        $cash = CashAdvance::with(['sdo', 'papData', 'liquidation'])
            ->find($this->cashAdvanceId);

        if (! $cash) {
            return collect([]);
        }

        $papName = optional($cash->papData)->pap_name;   // ← PAP name instead of ID

        /* ------------------------------------------------------------------
         | Row 1: Cash‑Advance header
         * ---------------------------------------------------------------- */
        $rows = collect([[
            optional($cash->sdo)->name,
            $cash->particulars,
            $papName,                       // PAP name here
            $cash->transaction_type,
            $cash->check_number,
            $this->d($cash->check_date),
            $cash->dv_number,
            $this->d($cash->dv_date),
            $cash->ors_number,
            $this->d($cash->ors_date),
            $this->d($cash->payout_start),
            $this->d($cash->payout_end),
            'Cash Advance ' . Carbon::parse($cash->check_date)->format('Y'),
            $cash->granted_amount,
            '-', // Liquidated Amount
            '-', // Liq Date Received
            '-', // Liq Number
            '-', // Liq Date
            '-', // OR Number
            '-', // OR Date
            $this->d($cash->created_at),
        ]]);

        /* ------------------------------------------------------------------
         | Rows 2+: each liquidation
         * ---------------------------------------------------------------- */
        foreach ($cash->liquidation as $liq) {
            $rows->push([
                optional($cash->sdo)->name,
                $cash->particulars,
                $papName,                   // PAP name repeated
                $cash->transaction_type,
                $cash->check_number,
                $this->d($cash->check_date),
                $cash->dv_number,
                $this->d($cash->dv_date),
                $cash->ors_number,
                $this->d($cash->ors_date),
                $this->d($cash->payout_start),
                $this->d($cash->payout_end),
                $liq->liquidation_type,
                $liq->granted_amount,
                $liq->for_liquidation_amount,
                $this->d($liq->liq_date_received),
                $liq->liq_number,
                $this->d($liq->liq_date),
                $liq->or_number,
                $this->d($liq->or_date),
                $this->d($liq->created_at),
            ]);
        }

        return $rows;
    }

    /** Column headers */
    public function headings(): array
    {
        return [
            'SDO Name',
            'Particulars',
            'PAP',                 // now shows PAP name
            'Transaction Type',
            'Check Number',
            'Check Date',
            'DV Number',
            'DV Date',
            'ORS Number',
            'ORS Date',
            'Payout Start',
            'Payout End',
            'Liquidation Type',
            'Granted Amount',
            'Liquidated Amount',
            'Liq Date Received',
            'Liq Number',
            'Liq Date',
            'OR Number',
            'OR Date',
            'Created At',
        ];
    }
}
