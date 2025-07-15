<?php

namespace App\Imports;

use App\Models\CashAdvance;
use App\Models\Sdo;
use App\Models\Pap;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Carbon;

class CashAdvanceImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip header row (assuming first row is headers)
        $rows->skip(1)->each(function ($row) {
            // Convert sdo_name to sdo_id
            $sdo = Sdo::where('name', trim($row[0]))->first();
            $pap = Pap::where('pap_name', trim($row[9]))->first();

            if (! $sdo || ! $pap) {
                // Skip or handle missing references gracefully
                return;
            }

            CashAdvance::create([
                'sdo_id'           => $sdo->id,
                'check_number'     => $row[1],
                'check_date'       => $this->parseDate($row[2]),
                'dv_number'        => $row[3],
                'dv_date'          => $this->parseDate($row[4]),
                'ors_number'       => $row[5],
                'ors_date'         => $this->parseDate($row[6]),
                'particulars'      => $row[7],
                'transaction_type' => $row[8],
                'pap'              => $pap->id,
                'granted_amount'   => $row[10],
                'payout_start'     => $this->parseDate($row[11]),
                'payout_end'       => $this->parseDate($row[12]),
                'status'           => 'Ongoing',
            ]);
        });
    }

    private function parseDate($value)
    {
        try {
            return $value ? Carbon::parse($value) : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}

