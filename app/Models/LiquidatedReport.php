<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiquidatedReport extends Model
{
    protected $fillable = [
        'liquidation_id',
        'cash_advance_id',
        'sdo_name',
        'check_number',
        'granted_amount',
        'for_liquidation_amount',
        'for_compliance_amount',
        'pre_audited_amount',
        'liquidation_type',
        'status',
        'liq_date_received',
        'liq_number',
        'liq_date',
        'or_number',
        'or_date',
        'pre_auditor',
        'jev_no',
    ];

}
