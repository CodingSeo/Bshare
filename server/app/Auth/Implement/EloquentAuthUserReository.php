<?php

namespace App\Auth\Implement;

use App\Auth\Interfaces\AuthUserRepository;
use App\EloquentModel\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

class EloquentAuthUserReository extends AuthUserRepository
{
    protected $user;
    protected $hasher;
    public $id_key = 'email';
    public function __construct(Hasher $hasher, User $user)
    {
        $this->hasher = $hasher;
        $this->user = $user;
    }
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return array|null;
     */
    public function retrieveById($identifier) :?array
    {
        $user = $this->user->where($this->id_key, $identifier)->first();
        return is_null($user)
                ? null
                : $user->toArray();
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return array|null;
     */
    public  function retrieveByToken($identifier, $token)
    {
        //todo
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public  function updateRememberToken(Authenticatable $user, $token)
    {
        //todo
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return array|null;
     */
    public  function retrieveByCredentials(array $credentials) :?array
    {
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists($this->password_key, $credentials))) {
            return null;
        }

        $query = $this->user->newQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, $this->password_key)) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        $user = $query->first();
        return is_null($user)
                ? null
                : $user->toArray();
    }
    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public  function validateCredentials(Authenticatable $user, array $credentials) : bool
    {
        $plain = $credentials[$this->password_key];
        return $this->hasher->check($plain, $user->getAuthPassword());
    }

}
