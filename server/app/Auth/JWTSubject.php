<?php

namespace App\Auth;

use App\Auth\Interfaces\AuthUserRepository;

trait JWTSubject
{
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(){
        return $this->attributes[$this->getAuthIdentifierName()];
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(){
        return [

        ];
    }
}
