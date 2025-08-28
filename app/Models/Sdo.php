<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdo extends Model
{
    use HasFactory;

    // If your table name is not 'sdos', keep this line:
    protected $table = 'sdo';

    protected $fillable = [
    'name',
    'email',
    'corporate_email',
    'contact_number',
    'position',
    'official_station',
    'employment_status',
];

    public function cashAdvance()
    {
        // This assumes each SDO can have one latest ongoing cash advance
        return $this->hasOne(CashAdvance::class)->latestOfMany();
    }

    public function cashAdvances()
    {
        return $this->hasMany(\App\Models\CashAdvance::class, 'sdo_id');
    }

    public function bondedOfficial()
{
    // Assuming bonded_officials table has sdo_id as a foreign key
    return $this->hasOne(\App\Models\BondedOfficial::class, 'sdo_id', 'id');
}

}
