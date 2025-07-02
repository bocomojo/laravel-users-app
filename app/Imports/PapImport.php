<?php

namespace App\Imports;

use App\Models\Pap;
use Maatwebsite\Excel\Concerns\ToModel;

class PapImport implements ToModel
{
    public function model(array $row)
    {
        return new Pap([
            'pap_name' => $row[0],
            'pap_code' => $row[1],
        ]);
    }
}

