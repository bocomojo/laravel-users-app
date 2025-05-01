<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdo extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default
    protected $table = 'sdo';

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'email', 'contact_number'];
}
