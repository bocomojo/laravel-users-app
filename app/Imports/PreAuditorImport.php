<?php

namespace App\Imports;

use App\Models\PreAuditor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PreAuditorImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PreAuditor([
            'name' => $row['name'] ?? null,
        ]);
    }
}
