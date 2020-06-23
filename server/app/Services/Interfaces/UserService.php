<?php

namespace App\Services\Interfaces;

use App\DTO\UserDTO;

interface UserService
{
    public function registerUser(array $user_info) : UserDTO;
    public function loginUser(array $user_info);
    public function getUserInfo();
    public function refreshToken();
    public function logoutUser();
}
