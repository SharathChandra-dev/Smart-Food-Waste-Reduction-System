<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTwoFactor extends Model
{
    protected $table = 'user_2fa';
    protected $primaryKey = 'id_user_2fa_sfwr';

    protected $fillable = [
        'user_id_sfwr',
        'secret_base32_sfwr',
        'enabled_sfwr'
    ];
}