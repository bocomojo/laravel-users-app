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
    ];

    public function preAuditor()
    {
        return $this->belongsTo(PreAuditor::class);
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
