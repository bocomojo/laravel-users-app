<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pap extends Model
{
    use HasFactory;

    protected $table = 'pap';
    protected $fillable = ['pap_name', 'pap_code'];
    public function cashAdvances()
{
    return $this->hasMany(CashAdvance::class, 'pap');
}

}
