<?php

namespace App\Imports;

use App\Models\Sdo;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;

class SdoImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        if (Sdo::where('email', $row['email'])->exists()) {
            return null; // skip duplicates
        }

        return new Sdo([
            'name'              => $row['name'],
            'position'          => $row['position'],
            'official_station'  => $row['official_station'],
            'employment_status' => $row['employment_status'],
            'email'             => $row['email'],
            'corporate_email'   => $row['corporate_email'],
            'contact_number'    => $row['contact_number'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => ['required', 'string'],
            '*.email' => ['required', 'email'],
            '*.contact_number' => ['required'],
        ];
    }
}
