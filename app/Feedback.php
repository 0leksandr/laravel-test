<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'subject',
        'message',
        'client_id',
        'file',
    ];
}
