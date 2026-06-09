<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [

        'name_sfwr',
        'email_sfwr',
        'subject_sfwr',
        'message_sfwr',
        'admin_response_sfwr',
        'replied_at_sfwr',

    ];

    protected $casts = [
        'replied_at_sfwr' => 'datetime',
    ];
}