<?php

namespace App\Imports;

use App\Models\Sdo;
use App\Models\BondedOfficial;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Validators\Failure;

class SdoImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithChunkReading
{
    use SkipsFailures;

    public function prepareForValidation($data, $index)
    {
        $normalized = [];
        foreach ($data as $key => $value) {
            $normalized[strtolower(trim($key))] = $value;
        }
        return $normalized;
    }

    public function model(array $row)
    {
        Log::info('Processing Row:', $row);

        // Find existing SDO
        $existingSdo = null;
        if (!empty($row['name'])) {
            $existingSdo = Sdo::whereRaw('LOWER(name) = ?', [strtolower(trim($row['name']))])->first();
        }
        if (!$existingSdo && !empty($row['email'])) {
            $existingSdo = Sdo::where('email', trim($row['email']))->first();
        }

        // If SDO exists
        if ($existingSdo) {
            $bondedExists = BondedOfficial::where('sdo_id', $existingSdo->id)->exists();

            if (!$bondedExists) {
                Log::info('Adding BondedOfficial to existing SDO:', ['sdo_id' => $existingSdo->id]);
                BondedOfficial::create([
                    'sdo_id'                   => $existingSdo->id,
                    'bond_status'              => $row['bond_status'] ?? null,
                    'approved_bond_amount'     => $row['approved_bond_amount'] ?? 0,
                    'max_cash'                 => $row['max_cash'] ?? 0,
                    'effective_date'           => $row['effective_date'] ?? null,
                    'expiration_date'          => $row['expiration_date'] ?? null,
                    'unliquidated_amount'      => $row['unliquidated_amount'] ?? 0,
                    'date_received_accounting' => $row['date_received_accounting'] ?? null,
                    'date_complied'            => $row['date_complied'] ?? null,
                    'compliance_date_returned' => $row['compliance_date_returned'] ?? null,
                ]);
            } else {
                Log::info('SDO already has bonded official, skipping:', ['sdo_id' => $existingSdo->id]);
            }

            return null;
        }

        // Create SDO
        $sdo = Sdo::create([
            'name'              => $row['name'] ?? null,
            'position'          => $row['position'] ?? null,
            'official_station'  => $row['official_station'] ?? null,
            'employment_status' => $row['employment_status'] ?? null,
            'email'             => $row['email'] ?? null,
            'corporate_email'   => $row['corporate_email'] ?? null,
            'contact_number'    => $row['contact_number'] ?? null,
        ]);

        // Create BondedOfficial for new SDO
        BondedOfficial::create([
            'sdo_id'                   => $sdo->id,
            'bond_status'              => $row['bond_status'] ?? null,
            'approved_bond_amount'     => $row['approved_bond_amount'] ?? 0,
            'max_cash'                 => $row['max_cash'] ?? 0,
            'effective_date'           => $row['effective_date'] ?? null,
            'expiration_date'          => $row['expiration_date'] ?? null,
            'unliquidated_amount'      => $row['unliquidated_amount'] ?? 0,
            'date_received_accounting' => $row['date_received_accounting'] ?? null,
            'date_complied'            => $row['date_complied'] ?? null,
            'compliance_date_returned' => $row['compliance_date_returned'] ?? null,
        ]);

        return $sdo;
    }

    public function rules(): array
    {
        return [
            '*.name'                     => 'required|string|max:255',
            '*.email'                    => 'nullable|email',
            '*.corporate_email'          => 'nullable|email|max:255',
            '*.contact_number'           => 'nullable|string|max:20',
            '*.position'                 => 'nullable|string|max:255',
            '*.official_station'         => 'nullable|string|max:255',
            '*.employment_status'        => 'nullable|string|max:255',
            '*.bond_status'              => 'nullable|string|in:With SO,Without SO',
            '*.approved_bond_amount'     => 'nullable|numeric|min:0',
            '*.max_cash'                 => 'nullable|numeric|min:0',
            '*.effective_date'           => 'nullable|date',
            '*.expiration_date'          => 'nullable|date',
            '*.unliquidated_amount'      => 'nullable|numeric|min:0',
            '*.date_received_accounting' => 'nullable|date',
            '*.date_complied'            => 'nullable|date',
            '*.compliance_date_returned' => 'nullable|date',
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

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            Log::error('Row skipped: ' . $failure->row() . ' - ' . implode(', ', $failure->errors()));
        }
    }
}
