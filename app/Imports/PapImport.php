<?php

namespace App\Imports;

use App\Models\Pap;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class PapImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Skip header or empty rows
            if ($row[0] == 'pap_name' || empty($row[0])) continue;

            // Skip if pap_name already exists
            if (Pap::where('pap_name', $row[0])->exists()) continue;

            Pap::create([
                'pap_name' => $row[0],
                'pap_code' => $row[1] ?? '',
            ]);
        }
    }
}
