<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CondensedLiquidationExport implements FromCollection, WithHeadings
{
    protected $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return collect($this->records)->map(function ($liq) {
            return [
                $liq->cashAdvance->sdo->name ?? '',
                $liq->check_number,
                $liq->granted_amount,
                $liq->for_liquidation_amount,
                $liq->liquidation_type,
                $liq->liq_date_received,
                $liq->liq_number,
                $liq->liq_date,
                $liq->or_number,
                $liq->or_date,
            ];
        });
    }

    public function headings(): array
    {
        return ['SDO', 'Check #', 'Granted', 'Liquidated', 'Type', 'Received', 'Liq #', 'Liq Date', 'OR #', 'OR Date'];
    }
}

