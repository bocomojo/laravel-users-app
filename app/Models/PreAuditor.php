<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Liquidation;
use App\Models\PreAuditorLiquidationEntry;

class PreAuditor extends Model
{
    protected $fillable = ['user_id', 'name'];
    protected $table = 'pre_auditors';

    /**
     * All pre-audit entries done by this auditor.
     */
    public function preAuditEntries()
    {
        return $this->hasMany(PreAuditorLiquidationEntry::class, 'pre_auditor_id');
    }

    /**
     * Convenience alias for entries.
     */
    public function liquidationEntries()
    {
        return $this->preAuditEntries();
    }

    /**
     * All liquidations related to this auditor via entries.
     */
    public function liquidations()
    {
        return $this->hasManyThrough(
            Liquidation::class,
            PreAuditorLiquidationEntry::class,
            'pre_auditor_id',  // Foreign key on entries table
            'id',              // Foreign key on liquidations table
            'id',              // Local key on pre_auditors table
            'liquidation_id'   // Local key on entries table
        )->distinct();
    }

    /**
     * Convenience relation back to the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
