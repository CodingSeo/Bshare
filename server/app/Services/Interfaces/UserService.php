<?php

namespace App\Services\Interfaces;

interface UserService
{
    public function registerUser(array $user_info);
    public function loginUser(array $user_info);
    public function getUserInfo();
    public function refreshToken();
    public function logoutUser();
}
