<?php

namespace App\Repositories\Implement;

use App\DTO\UserDTO;
use App\EloquentModel\User;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\UserRepository;

class UserRepositoryImp implements UserRepository
{
    protected $mapper;
    public function __construct(MapperService $mapper)
    {
        $this->mapper = $mapper;
    }
    public function getOne(int $id)
    {
        $user = User::find($id);
        return $this->mapper->map($user, UserDTO::class);
    }
    public function getOneByEmail(string $email): UserDTO
    {
        $user = User::where('email', $email)->first();
        return $this->mapper->map($user, UserDTO::class);
    }
    public function getOneOrCreateByEmail(array $user_info): UserDTO
    {
        $email = $user_info['user_id'];
        $name = $user_info['name'];
        $user = (User::where('email', $email)->first())?:
                User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt('Oauth_login_password'),
                    'password_bcrypt' => bcrypt('Oauth_login_password'),
                ]);
        return $this->mapper->map($user, UserDTO::class);
    }
    public function findAll(): array
    {
        $users = User::all();
        return $this->mapper->mapArray($users, UserDTO::class);
    }

    public function delete(UserDTO $user): bool
    {
        $result = User::where('id',$user->id)->delete();
        return $result;
    }

    public function save($content): UserDTO
    {
        $user = new User();
        $user->name = $content['name'];
        $user->email = $content['email'];
        $user->password = bcrypt($content['password']);
        $user->password_bcrypt = $content['password'];
        $user->save();
        return $this->mapper->map($user, UserDTO::class);
    }
}
