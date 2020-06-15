<?php

namespace App\Repositories\Implement;

use App\EloquentModel\User;
use App\Repositories\interfaces\UserRepository;

class UserRepositoryImp implements UserRepository
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
    public function getOne(int $id): object
    {
    }
    public function findAll(): object
    {
    }
    public function update(object $content): object
    {
    }
    public function delete(object $content): object
    {
    }
    public function save(object $content): object
    {
    }
}
