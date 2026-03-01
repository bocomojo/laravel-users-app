<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PreAuditor;
use App\Models\PreAuditorLiquidationEntry;
use App\Models\CashAdvance;
use App\Models\LiquidationActivity;
use App\Models\SDO;
use App\Models\SackAssignment;

class Liquidation extends Model
{
    use HasFactory;

    protected $table = 'liquidation';

    protected $fillable = [
        'cash_advance_id',
        'sdo_name',
        'check_number',
        'granted_amount',
        'for_liquidation_amount',
        'liquidation_type',
        'liq_date_received',
        'liq_number',
        'liq_date',
        'or_number',
        'or_date',
        'for_compliance_amount',
        'pre_audited_amount',
        'pre_auditor',
        'jev_no',
        'status',
    ];

    // Relations

    public function cashAdvance()
    {
        return $this->belongsTo(CashAdvance::class, 'cash_advance_id');
    }

    // public function activities()
    // {
    //     return $this->hasMany(LiquidationActivity::class)->latest();
    // }

public function activities()
{
    return $this->hasMany(\App\Models\LiquidationActivity::class);
}

    /**
     * All pre-audit entries for this liquidation
     */
    public function preAuditEntries()
    {
        return $this->hasMany(PreAuditorLiquidationEntry::class, 'liquidation_id');
    }

    /**
     * Single pre-audit entry (optional)
     */
    public function preAuditorEntry()
    {
        return $this->hasOne(PreAuditorLiquidationEntry::class, 'liquidation_id');
    }

    /**
     * Compliance entries only
     */
    public function complianceFiles()
    {
        return $this->hasMany(PreAuditorLiquidationEntry::class, 'liquidation_id')
                    ->where('for_compliance', true);
    }

    /**
     * All pre-auditors that have entries for this liquidation
     */
    public function preAuditors()
    {
        return $this->hasManyThrough(
            PreAuditor::class,
            PreAuditorLiquidationEntry::class,
            'liquidation_id',   // FK on entries table
            'id',               // PK on pre_auditors table
            'id',               // Local PK on liquidation
            'pre_auditor_id'    // FK on entries table
        )->distinct();
    }

    /**
     * Convenience relation to single pre-auditor (if using 'pre_auditor' column)
     */
    public function preAuditor()
    {
        return $this->belongsTo(PreAuditor::class, 'pre_auditor');
    }

    public function sdo()
    {
        return $this->belongsTo(SDO::class, 'sdo_id');
    }

    public function sackAssignments()
    {
        return $this->hasMany(SackAssignment::class, 'liq_number', 'liq_number');
    }

    // Accessors

    public function getDisplayStatusAttribute()
    {
        // Don't override finalized or approved statuses
        if (!in_array($this->status, ['For Checking', 'Processing'])) {
            return $this->status;
        }

        // Show 'Processing' only if it is still 'For Checking' and has entries
        $hasEntries = $this->relationLoaded('preAuditEntries')
            ? $this->preAuditEntries->isNotEmpty()
            : $this->preAuditEntries()->exists();

        if ($this->status === 'For Checking' && $hasEntries) {
            return 'Processing';
        }

        return $this->status;
    }
}
