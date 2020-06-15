<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $user_repository;
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }
    public function registerUser(array $user_info)
    {
        $user = $this->user_repository->registerUser($user_info);
        return collect($user);
    }
    public function loginUser(array $user_info){
        $email = $user_info['email'];
        $password = $user_info['password'];
        $token = auth('api')->attempt(['email' => $email, 'password' => $password]);
        if (!$token){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $token;
    }
    public function getUserInfo(){
        return collect(auth()->user());
    }
    public function refreshToken(){
        return auth('api')->refresh();
    }
    public function logoutUser(){
        return auth()->logout();
    }
}
