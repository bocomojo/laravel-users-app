<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiquidationActivity extends Model
{
    protected $fillable = [
        'liquidation_id',
        'user_id',
        'action',
        'details',
    ];
    
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

}
