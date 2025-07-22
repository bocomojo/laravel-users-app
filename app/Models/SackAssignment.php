<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SackAssignment extends Model
{
    protected $table = 'sack_assignment';

    protected $fillable = ['liq_number', 'sack_number'];

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class, 'liq_number', 'liq_number');
    }
}
