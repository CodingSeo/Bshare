<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\Auth\Manager\JWTAuthManager;
use App\DTO\UserDTO;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\UserService;

class UserServiceImp implements UserService
{
    /**
     * @var UserRepository
     */
    protected $user_repository;
    /**
     *
     * @var JWTAuthManager
     */
    protected $jwtauth;
    public function __construct(UserRepository $user_repository, JWTAuthManager $jwtauth)
    {
        $this->user_repository = $user_repository;
        $this->jwtauth = $jwtauth;
    }

    public function registerUser(array $content): UserDTO
    {
        $email = $content['email'];
        $user_check = $this->user_repository->getOneByEmail($email);
        if ($user_check->id) throw new \App\Exceptions\ModuleNotFound('User already exists');
        $user = $this->user_repository->save($content);
        return $user;
    }
    //gaurd part???
    public function loginUser(array $user_info): AuthUser
    {
        $email = $user_info['email'];
        $password = $user_info['password'];
        $user = $this->user_repository->getOneByEmail($email);
        if (!$user->id) throw new \App\Exceptions\ModuleNotFound('User does not exists');
        if (!strcmp($user->password, bcrypt($password))) throw new \App\Exceptions\ModuleNotFound('Password Incorrect');
        $authUser = $this->jwtauth->getAuthUserByUserDTO($user);
        return $authUser;
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
