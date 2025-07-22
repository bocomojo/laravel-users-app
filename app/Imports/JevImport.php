<?php

namespace App\Imports;

use App\Models\Liquidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JevImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $liqNumber = $row['lr_number'] ?? null; // from Excel
            $jevNo = $row['jev_no'] ?? null;         // from Excel
\Log::info('Row:', $row->toArray());

            if ($liqNumber && $jevNo) {
                $updated = Liquidation::where('liq_number', $liqNumber)
                    ->update(['jev_no' => $jevNo]);

                \Log::info("Updated $updated record(s) for LIQ#: $liqNumber => JEV#: $jevNo");

                if ($updated === 0) {
                    \Log::warning("No matching LIQ number found for: $liqNumber");
                }
            }
        }
    }
}
