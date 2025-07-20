<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class BondedOfficial extends Model
{
    protected $fillable = [
        'sdo_id',
        'bond_status',
        'approved_bond_amount',
        'max_cash',
        'effective_date',
        'expiration_date',
        'aging',
        'unliquidated_amount',
        'date_received_accounting',
        'date_complied',
        'compliance_date_returned',
    ];

    public function sdo()
    {
        return $this->belongsTo(Sdo::class);
    }

    public function getAgingAttribute()
    {
        if (!$this->expiration_date) {
            return 'N/A';
        }

        $now = Carbon::now();
        $expiration = Carbon::parse($this->expiration_date);

        $diff = (int) $now->diffInDays($expiration, false); // ensures it's an integer

        if ($diff > 0) {
            return "$diff days remaining";
        } elseif ($diff === 0) {
            return "Expires today";
        } else {
            return abs($diff) . " days overdue";
        }
    }
}
