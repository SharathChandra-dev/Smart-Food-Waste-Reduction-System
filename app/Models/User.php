<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'password_sfwr',
    ];

    public function getAuthIdentifierName(): string
    {
        return 'id_user_sfwr';
    }

    // Returns the actual hashed password VALUE from your custom column
    public function getAuthPassword(): string
    {
        return $this->password_sfwr;
    }
}