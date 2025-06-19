<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    use HasFactory;

    protected $table = 'cash_advance';

    protected $fillable = [
        'sdo_id',
        'check_number',
        'check_date',
        'dv_number',
        'dv_date',
        'ors_number',
        'ors_date',
        'particulars',
        'transaction_type',
        'pap',
        'granted_amount',
        'status',
        
    ];

    protected $casts = [
        'granted_amount' => 'float',
    ];

    /**
     * Get the SDO associated with this cash advance.
     */
    public function sdo()
    {
        return $this->belongsTo(Sdo::class, 'sdo_id');
    }

    public function liquidations()
    {
        return $this->hasMany(\App\Models\Liquidation::class);
    }

}
