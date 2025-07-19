<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BondedOfficial extends Model
{
    protected $fillable = [
        'sdo_id',
        'bond_status',
        'approved_bond_amount',
        'max_cash',
        'effective_date',
        'expiration_date',
        'aging',
        'unliquidated_amount',
        'date_received_accounting',
        'date_complied',
        'compliance_date_returned',
    ];

    public function sdo()
    {
        return $this->belongsTo(Sdo::class);
    }
}
