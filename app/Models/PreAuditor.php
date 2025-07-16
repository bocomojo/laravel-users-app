<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreAuditor extends Model
{
    protected $fillable = ['name'];

    public function preAuditEntries()
    {
        return $this->hasMany(PreAuditorLiquidationEntry::class);
    }

    public function liquidationEntries()
    {
        return $this->hasMany(\App\Models\PreAuditorLiquidationEntry::class);
    }

    public function liquidation()
    {
        return $this->belongsToMany(Liquidation::class, 'pre_auditor_liquidation');
    }

    public function assignedLiquidations()
    {
        return $this->belongsToMany(Liquidation::class, 'pre_auditor_liquidation');
    }

}
