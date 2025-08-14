<?php

namespace App\Imports;

use App\Models\Liquidation;
use App\Models\Sdo;
use App\Models\CashAdvance;
use App\Models\PreAuditor;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LiquidationImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $sdoName = trim($row['sdo_name']);
            $checkNumber = trim($row['check_number']);
            $liqType = strtolower(trim($row['liquidation_type'] ?? ''));

            // Find related CashAdvance
            $cashAdvance = CashAdvance::where('check_number', $checkNumber)->first();
            if (!$cashAdvance) {
                continue; // Skip if no matching CashAdvance
            }

            // Clean up auditor names (comma-separated)
            $preAuditorNames = array_filter(array_map('trim', explode(',', $row['pre_auditor'] ?? '')));

            DB::transaction(function () use ($row, $sdoName, $cashAdvance, $preAuditorNames, $liqType) {
                // Determine status based on liquidation_type
                $status = $liqType === 'refund' ? 'Approved' : 'For Checking';

                // Create liquidation
                $liq = Liquidation::create([
                    'sdo_name'              => $sdoName,
                    'cash_advance_id'       => $cashAdvance->id,
                    'check_number'          => $row['check_number'],
                    'granted_amount'        => $row['granted_amount'],
                    'liquidation_type'      => $row['liquidation_type'],
                    'for_liquidation_amount'=> $row['for_liquidation_amount'],
                    'liq_date_received'     => is_numeric($row['liq_date_received']) 
                        ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['liq_date_received'])->format('Y-m-d') 
                        : ($row['liq_date_received'] ?? null),

                    'liq_number'            => $row['liq_number'] ?? null,
                    'or_number'             => $row['or_number'] ?? null,
                    'or_date'               => is_numeric($row['or_date']) 
                        ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['or_date'])->format('Y-m-d') 
                        : ($row['or_date'] ?? null),

                    'status'                => $status,
                    'pre_auditor'           => implode(', ', $preAuditorNames),
                    // 'pre_audited_amount'    => $row['for_liquidation_amount'],
                    'fo_compliance_amount'  => $row['fo_compliance_amount'] ?? null,
                ]);

                // Attach to pivot table: pre_auditor_liquidation
                if (!empty($preAuditorNames)) {
                    $auditorIds = PreAuditor::whereIn(
                        DB::raw('LOWER(name)'), 
                        collect($preAuditorNames)->map(fn($n) => strtolower($n))->toArray()
                    )->pluck('id');
                    $liq->preAuditors()->sync($auditorIds);
                }
            });
        }
    }
}
