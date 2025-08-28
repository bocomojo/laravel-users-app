<?php

namespace App\Imports;

use App\Models\Liquidation;
use App\Models\CashAdvance;
use App\Models\PreAuditor;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class LiquidationImport implements ToCollection, WithHeadingRow
{
    protected array $skipped = [];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            // ✅ Skip completely empty rows (avoid inflating skipped count)
            if (
                empty(trim($row['sdo_name'] ?? '')) &&
                empty(trim($row['check_number'] ?? '')) &&
                empty(trim($row['liq_number'] ?? ''))
            ) {
                continue;
            }

            $sdoName     = trim($row['sdo_name'] ?? '');
            $checkNumber = trim($row['check_number'] ?? '');
            $liqType     = strtolower(trim($row['liquidation_type'] ?? ''));

            // ✅ Explicitly handle missing check number
            if (empty($checkNumber)) {
                $this->skipped[] = [
                    'reason'       => 'Missing check number',
                    'sdo_name'     => $sdoName,
                    'check_number' => 'N/A',
                    'liq_number'   => $row['liq_number'] ?? 'N/A',
                ];
                continue;
            }

            // Find related CashAdvance
            $cashAdvance = CashAdvance::where('check_number', $checkNumber)->first();

            if (!$cashAdvance) {
                $this->skipped[] = [
                    'reason'       => 'No matching Cash Advance',
                    'sdo_name'     => $sdoName,
                    'check_number' => $checkNumber,
                    'liq_number'   => $row['liq_number'] ?? 'N/A',
                ];
                continue;
            }

            // ✅ Skip if Cash Advance is Cancelled
            if (strtolower($cashAdvance->status) === 'cancelled') {
                $this->skipped[] = [
                    'reason'       => 'Cash Advance is Cancelled',
                    'sdo_name'     => $sdoName,
                    'check_number' => $checkNumber,
                    'liq_number'   => $row['liq_number'] ?? 'N/A',
                ];
                continue;
            }

            // Parse pre-auditor names (comma separated)
            $preAuditorNames = array_filter(
                array_map('trim', explode(',', $row['pre_auditor'] ?? ''))
            );

            DB::transaction(function () use ($row, $sdoName, $cashAdvance, $preAuditorNames, $liqType) {
                $status = $liqType === 'refund' ? 'Approved' : 'For Checking';

                $liq = Liquidation::create([
                    'sdo_name'               => $sdoName,
                    'cash_advance_id'        => $cashAdvance->id,
                    'check_number'           => $row['check_number'],
                    'granted_amount'         => $row['granted_amount'] ?? null,
                    'liquidation_type'       => $row['liquidation_type'] ?? null,
                    'for_liquidation_amount' => $row['for_liquidation_amount'] ?? null,
                    'liq_date_received'      => $this->parseExcelDate($row['liq_date_received'] ?? null),
                    'liq_number'             => $row['liq_number'] ?? null,
                    'or_number'              => $row['or_number'] ?? null,
                    'or_date'                => $this->parseExcelDate($row['or_date'] ?? null),
                    'status'                 => $status,
                    'pre_auditor'            => implode(', ', $preAuditorNames),
                    'fo_compliance_amount'   => $row['fo_compliance_amount'] ?? null,
                ]);

                // Sync pre-auditors if available
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

    /**
     * Convert Excel date or return as-is if already string/nullable.
     */
    protected function parseExcelDate($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
        }

        return $value;
    }

    /**
     * Get skipped rows with reasons.
     */
    public function getSkipped(): array
    {
        return $this->skipped;
    }
}
