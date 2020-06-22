<?php

namespace App\EloquentModel;

use Illuminate\Contracts\Auth\UserProvider;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'id','name', 'email', 'password',
    ];

    protected $hidden = [
        'password_bcrypt'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            // 'name' => $this->name,
            // 'email' => $this->email
        ];
    }
}
