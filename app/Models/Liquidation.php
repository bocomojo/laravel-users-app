<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function cashAdvance()
    {
        return $this->belongsTo(\App\Models\CashAdvance::class, 'cash_advance_id');
    }

    public function activities()
    {
        return $this->hasMany(LiquidationActivity::class)->latest();
    }

    public function preAuditors()
    {
        return $this->belongsToMany(
            PreAuditor::class,
            'pre_auditor_liquidation',
            'liquidation_id',
            'pre_auditor_id'
        )->withTimestamps();
    }

    public function preAuditor()
    {
        return $this->belongsTo(PreAuditor::class, 'pre_auditor');
    }

    public function preAuditEntries()
    {
        return $this->hasMany(\App\Models\PreAuditorLiquidationEntry::class);
    }

    public function preAuditorEntry()
    {
        return $this->hasOne(\App\Models\PreAuditorLiquidationEntry::class, 'liquidation_id');
    }

    public function complianceFiles()
    {
        return $this->hasMany(\App\Models\PreAuditorLiquidationEntry::class, 'liquidation_id')
                    ->where('for_compliance', true);
    }

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
 
    public function sdo()
    {
        return $this->belongsTo(SDO::class, 'sdo_id');
    }

    public function sackAssignments()
    {
        return $this->hasMany(SackAssignment::class, 'liq_number', 'liq_number');
    }

}