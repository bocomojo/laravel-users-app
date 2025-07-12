<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BondedOfficial extends Model
{
    protected $fillable = [
        'sdo_id',
        'status',
        'approved_bond_amount',
        'max_cash_accountability',
        'effectivity_date',
        'expiration_date',
        'remarks',
        'unfor_liquidation_amount',
        'received_in_accounting',
        'remarks_status',
        'date_complied',
        'compliance_returned',
    ];

    /**
     * Get the associated SDO (official).
     */
    public function sdo(): BelongsTo
    {
        return $this->belongsTo(Sdo::class);
    }
}
