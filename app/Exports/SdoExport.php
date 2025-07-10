<?php

namespace App\Exports;

use App\Models\Sdo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SdoExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Sdo::orderBy('name')
            ->select('name', 'position', 'official_station', 'employment_status', 'email', 'corporate_email', 'contact_number')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Position',
            'Official Station',
            'Employment Status',
            'Email',
            'Corporate Email',
            'Contact Number',
        ];
    }
}
