<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayoutDateHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_advance_id',
        'old_start',
        'old_end',
        'new_start',
        'new_end',
        'changed_at',
    ];

    public $timestamps = false; // Since we're using a custom timestamp field

    protected $casts = [
        'old_start' => 'date',
        'old_end' => 'date',
        'new_start' => 'date',
        'new_end' => 'date',
        'changed_at' => 'datetime',
    ];
}
