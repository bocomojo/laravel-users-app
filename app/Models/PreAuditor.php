<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreAuditor extends Model
{
    protected $fillable = ['user_id', 'name']; // ✅ added user_id
    protected $table = 'pre_auditors';
    
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

    // ✅ convenience relation back to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}