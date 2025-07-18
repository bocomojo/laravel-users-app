<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class CondensedLiquidationExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    protected $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return collect($this->records)->map(function ($liq) {
            $papId = $liq->cashAdvance->pap ?? null;
            $papName = $papId ? \App\Models\Pap::find($papId)?->pap_name : '';

            // Conditionally pick LR or OR fields
            $isRefund = strtolower($liq->liquidation_type) === 'refund';
            $number = $isRefund ? $liq->or_number : $liq->liq_number;
            $date   = $isRefund ? $liq->or_date   : $liq->liq_date;

            return [
                $liq->liq_date_received,                      // DATE RECEIVED
                $liq->cashAdvance->sdo->name ?? '',           // SDO
                $papName,                                     // PAP NAME
                $liq->check_number,                           // CHECK NUMBER
                $liq->cashAdvance->check_date ?? '',          // CHECK DATE
                $liq->cashAdvance->particulars ?? '',         // PARTICULARS
                $number,                                      // LR/OR NUMBER
                $date,                                        // LR/OR DATE
                $liq->for_liquidation_amount,                 // AMOUNT
                $liq->for_compliance_amount ?? 0,             // AMOUNT COMPLIANCE
                $liq->pre_audited_amount,                     // AUDITED AMOUNT
                $liq->jev_number ?? '',                       // JEV NUMBER
            ];
        });
    }

    public function headings(): array
    {
        return [
            'DATE RECEIVED',
            'SDO',
            'PAP',
            'CHECK NUMBER',
            'CHECK DATE',
            'PARTICULARS',
            'LR NUMBER',
            'LR DATE',
            'SUBMITTED AMOUNT',
            'AMOUNT FOR COMPLIANCE',
            'AUDITED AMOUNT',
            'JEV No.'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            3 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->insertNewRowBefore(1, 2);
                $sheet->mergeCells('A1:M1');
                $sheet->setCellValue('A1', 'VANESSA 2025');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                $sheet->getStyle('A3:M3')->getAlignment()->setHorizontal('center');
                $sheet->getStyle('A3:M3')->getFont()->setBold(true);

                $highestRow = $sheet->getHighestRow();

                // Currency columns: H (Amount), I (Compliance), J (Audited)
                foreach (['H', 'I', 'J'] as $col) {
                    $sheet->getStyle("{$col}4:{$col}{$highestRow}")
                        ->getNumberFormat()
                        ->setFormatCode('#,##0.00');
                }

                // Date columns: A, E, G, K, M
                foreach (['A', 'E', 'G', 'K', 'M'] as $col) {
                    $sheet->getStyle("{$col}4:{$col}{$highestRow}")
                        ->getNumberFormat()
                        ->setFormatCode('yyyy-mm-dd');
                }

                // Borders
                $sheet->getStyle("A3:M{$highestRow}")
                      ->getBorders()
                      ->getAllBorders()
                      ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Autosize all columns A–M
                foreach (range('A', 'M') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
