<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentMail extends Model
{
    protected $fillable = ['to', 'subject', 'body'];
}
