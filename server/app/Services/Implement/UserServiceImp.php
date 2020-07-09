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
        if ($user_check->id) throw new \App\Exceptions\ModuleNotSaved('User already exists');
        $user = $this->user_repository->save($content);
        return $user;
}

    public function loginUser(array $user_info): AuthUser
    {
        $email = $user_info['email'];
        $password = $user_info['password'];
        $user = $this->user_repository->getOneByEmail($email);
        if (!$user->id) throw new \App\Exceptions\IllegalUserApproach('User does not exists');
        if (!strcmp($user->password, bcrypt($password))) throw new \App\Exceptions\ModuleNotFound('Password Incorrect');
        $authUser = $this->jwtauth->getAuthUserByUserDTO($user);
        return $authUser;
    }

    public function loginOauthUser(array $user_info): AuthUser
    {
        $user = $this->user_repository->getOneOrCreateByEmail($user_info);
        if (!$user->id) throw new \App\Exceptions\ModuleNotSaved('User Login or Create error');
        $authUser = $this->jwtauth->getAuthUserByUserDTO($user);
        return $authUser;
    }

}
