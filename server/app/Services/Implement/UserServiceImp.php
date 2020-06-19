<?php

namespace App\Services\Implement;

use App\DTO\UserDTO;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\UserService;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserServiceImp implements UserService
{
    protected $user_repository;
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function registerUser(array $content): UserDTO
    {
        $user_check = $this->user_repository->getOneByEmail($content['email']);
        if ($user_check->id) throw new \App\Exceptions\ModuleNotFound('User already exists');
        $user = $this->user_repository->save($content);
        return $user;
    }

    public function loginUser(array $user_info)
    {
        $email = $user_info['email'];
        $password = $user_info['password'];
        $token = JWTAuth::attempt(['email' => $email, 'password' => $password]);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $token;
    }

    public function getUserInfo()
    {
        return auth('api')->user();
    }

    public function refreshToken()
    {

        return auth('api')->refresh();
    }

    public function logoutUser()
    {

        return auth()->logout();
    }
}
