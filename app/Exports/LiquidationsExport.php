<?php

namespace App\Exports;

use App\Models\Liquidation;
use App\Models\CashAdvance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class LiquidationsExport implements FromCollection, WithHeadings
{
    protected $cashAdvanceId;

    public function __construct($cashAdvanceId)
    {
        $this->cashAdvanceId = $cashAdvanceId;
    }

    public function collection()
    {
        $cashAdvance = CashAdvance::with('sdo')->find($this->cashAdvanceId);

        if (!$cashAdvance) {
            return collect([]);
        }

        return Liquidation::where('cash_advance_id', $this->cashAdvanceId)->get()->map(function ($liq) use ($cashAdvance) {
            return [
                optional($cashAdvance->sdo)->name,
                $cashAdvance->particulars,
                $cashAdvance->pap,
                $cashAdvance->transaction_type,
                $cashAdvance->check_number,
                $cashAdvance->check_date,
                $cashAdvance->dv_number,
                $cashAdvance->dv_date,
                $cashAdvance->ors_number,
                $cashAdvance->ors_date,
                $liq->liquidation_type,
                $liq->granted_amount,
                $liq->liquidated_amount,
                $liq->liq_date_received,
                $liq->liq_number,
                $liq->liq_date,
                $liq->or_number,
                $liq->or_date,
                $liq->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'SDO Name',
            'Particulars',
            'PAP',
            'Transaction Type',
            'Check Number',
            'Check Date',
            'DV Number',
            'DV Date',
            'ORS Number',
            'ORS Date',
            'Liquidation Type',
            'Grant Amount',
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
