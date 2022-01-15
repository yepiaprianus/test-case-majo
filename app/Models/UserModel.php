<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class UserModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = ['status', 'role', 'created_at'];

    protected $hidden = [
        'password',
        'api_token',
        'username'
    ];
}
