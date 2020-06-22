<?php

namespace App\Auth;

use App\Auth\Interfaces\AuthUserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class AuthUserProvider implements UserProvider
{
    /**
     * @var AuthUserRepository
     */
    public $authRepository;
    public function __construct(AuthUserRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier){
        $user = $this->authRepository->retrieveById($identifier);
        return $this->getAuthUser($user);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token){
        //todo getAuthUser
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token){
        //todo
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials){
        $user = $this->authRepository->retrieveByCredentials($credentials);
        return $this->getAuthUser($user);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials){
        return $this->authRepository->validateCredentials($user,$credentials);
    }

    /**
     * Formatting Generic User
     *
     * @param  array  $user
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getAuthUser($user)
    {
        $id_key = $this->authRepository->id_key;
        $password_key = $this->authRepository->password_key;
        $rememberToken = $this->authRepository->rememberToken;

        if (!is_null($user) && !empty($user)) {
            return new AuthUser((array) $user ,$id_key, $password_key, $rememberToken);
        }
    }
}
