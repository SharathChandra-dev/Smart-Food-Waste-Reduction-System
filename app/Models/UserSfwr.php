<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserSfwr extends Authenticatable
{
    protected $table = 'users_sfwr';

    protected $primaryKey = 'id_user_sfwr';

    public $timestamps = false;

    protected $fillable = [
        'username_sfwr',
        'email_sfwr',
        'password_sfwr',
        'role_sfwr',
    ];

    protected $hidden = [
        'password_sfwr'
    ];

    public function getAuthPassword()
    {
        return $this->password_sfwr;
    }
}