<?php

namespace App\Repositories;

use App\EloquentModel\User;

class UserRepository
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function registerUser($user_info)
    {
        $this->user->fill($user_info);
        $this->user->password = bcrypt($user_info['password']);
        $this->user->password_bcrypt = $user_info['password'];
        $this->user->save();
        return $this->user;
    }
}
