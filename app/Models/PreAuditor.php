<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreAuditor extends Model
{
    protected $fillable = ['name'];

    public function liquidations()
{
    return $this->belongsToMany(Liquidation::class, 'pre_auditor_liquidation');
}
}
