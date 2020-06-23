<?php

namespace App\Auth\Interfaces;

use Illuminate\Contracts\Auth\Authenticatable;

//interface로 할 경우 Id_key, password_key, remember_token을 사용할 수 없게 된다.
abstract class AuthUserRepository
{
    /**
     *
     * @var string
     */
    public $id_key = 'id';

    /**
     * @var string
     */
    public $password_key = 'password';

    /**
     * @var string|null
     */
    public $rememberToken = null;

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return array;
     */
    public abstract function retrieveById($identifier);

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return array|null;
     */
    public abstract function retrieveByToken($identifier, $token);

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public abstract function updateRememberToken(Authenticatable $user, $token);

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return array|null;
     */
    public abstract function retrieveByCredentials(array $credentials);

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public abstract function validateCredentials(Authenticatable $user, array $credentials);
}
