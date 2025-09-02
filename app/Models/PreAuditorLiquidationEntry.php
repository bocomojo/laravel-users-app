<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreAuditorLiquidationEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'pre_auditor_id',
        'liquidation_id',
        'amount',
        'for_compliance',
        'compliance_file',
        'pre_auditor',
    ];

    public function preAuditor()
    {
        return $this->belongsTo(User::class, 'pre_auditor_id');
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }

    public function bondedOfficial()
    {
        return $this->hasOne(BondedOfficial::class);
    }

}
