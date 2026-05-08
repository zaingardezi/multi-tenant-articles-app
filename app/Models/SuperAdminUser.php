<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuperAdminUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'superadmin';
    protected $table = 'superadmin_users'; 
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}