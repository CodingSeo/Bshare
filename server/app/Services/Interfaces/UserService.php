<?php

namespace App\Services\Interfaces;

use App\Auth\AuthUser;
use App\DTO\UserDTO;

interface UserService
{
    public function registerUser(array $user_info): UserDTO;
    public function loginUser(array $user_info): AuthUser;
    public function loginOauthUser(array $user_info): AuthUser;
}
