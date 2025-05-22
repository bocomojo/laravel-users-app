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
        'transaction_type',
        'granted_amount',
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
}
