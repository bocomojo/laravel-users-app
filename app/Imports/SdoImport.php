<?php

namespace App\Imports;

use App\Models\Sdo;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SdoImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithChunkReading
{
    use SkipsFailures;

    public function model(array $row)
{
    \Log::info('Importing Row:', $row);

    if (!empty($row['email']) && Sdo::where('email', $row['email'])->exists()) {
        \Log::info('Duplicate skipped:', ['email' => $row['email']]);
        return null;
    }

    return new Sdo([
        'name'              => $row['name'],
        'position'          => $row['position'] ?? null,
        'official_station'  => $row['official_station'] ?? null,
        'employment_status' => $row['employment_status'] ?? null,
        'email'             => $row['email'] ?? null,
        'corporate_email'   => $row['corporate_email'] ?? null,
        'contact_number'    => $row['contact_number'] ?? null,
    ]);
}


    public function rules(): array
{
    return [
        '*.name' => 'required|string|max:255',
        '*.email' => 'nullable|email|unique:sdo,email',
        '*.corporate_email' => 'nullable|email|max:255',
        '*.contact_number' => 'nullable|string|max:20',
        '*.position' => 'nullable|string|max:255',
        '*.official_station' => 'nullable|string|max:255',
        '*.employment_status' => 'nullable|string|max:255',
    ];
}


    public function chunkSize(): int
    {
        return 500;
    }

    public function headingRow(): int
    {
        return 1;
    }
}

