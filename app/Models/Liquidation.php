<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    use HasFactory;

    protected $table = 'liquidation'; // explicitly specify table name

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
    'pre_auditor_id',
];
public function cashAdvance()
{
    return $this->belongsTo(\App\Models\CashAdvance::class, 'cash_advance_id');
}


}
