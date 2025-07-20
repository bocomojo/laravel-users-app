<?php

namespace App\Exports;

use App\Models\CashAdvance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class LiquidationsExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    protected int|string $cashAdvanceId;

    public function __construct($cashAdvanceId)
    {
        $this->cashAdvanceId = $cashAdvanceId;
    }

    private function d($value): string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : '';
    }

    public function collection(): Collection
    {
        $cash = CashAdvance::with(['sdo', 'papData', 'liquidation'])
            ->find($this->cashAdvanceId);

        if (! $cash) {
            return collect([]);
        }

        $papName = optional($cash->papData)->pap_name;

        $rows = collect();

        // --- Cash Advance Card Header ---
        $rows->push(['CASH ADVANCE DETAILS']);
        $rows->push(['Label', 'Value']);
        $rows->push(['SDO Name', optional($cash->sdo)->name]);
        $rows->push(['Particulars', $cash->particulars]);
        $rows->push(['PAP', $papName]);
        $rows->push(['Transaction Type', $cash->transaction_type]);
        $rows->push(['Check Number', $cash->check_number]);
        $rows->push(['Check Date', $this->d($cash->check_date)]);
        $rows->push(['DV Number', $cash->dv_number]);
        $rows->push(['DV Date', $this->d($cash->dv_date)]);
        $rows->push(['ORS Number', $cash->ors_number]);
        $rows->push(['ORS Date', $this->d($cash->ors_date)]);
        $rows->push(['Payout Start', $this->d($cash->payout_start)]);
        $rows->push(['Payout End', $this->d($cash->payout_end)]);
        $rows->push(['Granted Amount', $cash->granted_amount]);
        $rows->push(['Created At', $this->d($cash->created_at)]);

        // Spacer
        $rows->push([]);
        $rows->push(['LIQUIDATION ENTRIES']);

        // --- Table Header ---
        $rows->push([
            'Liquidation Type',
            'Granted Amount',
            'Liquidated Amount',
            'Liq Date Received',
            'Liq Number',
            'Liq Date',
            'OR Number',
            'OR Date',
            'Created At'
        ]);

        // --- Table Rows ---
        foreach ($cash->liquidation as $liq) {
            $rows->push([
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

    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],  // "CASH ADVANCE DETAILS"
            2 => ['font' => ['bold' => true]],                // "Label", "Value"
            18 => ['font' => ['bold' => true, 'size' => 14]], // "LIQUIDATION ENTRIES"
            19 => ['font' => ['bold' => true]],               // Table Headers
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Apply thin border to all used cells
                $cellRange = $sheet->getDelegate()->calculateWorksheetDimension();
                $sheet->getDelegate()->getStyle($cellRange)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Auto-size all columns A–Z
                foreach (range('A', 'Z') as $col) {
                    $sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
