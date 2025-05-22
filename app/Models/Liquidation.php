<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    use HasFactory;

    protected $table = 'liquidations'; // explicitly specify table name

    protected $fillable = [
        'sdo_name',
        'check_number',
        'granted_amount',
        'liquidated_amount',
        'liquidation_type',
    ];
}
