<?php

namespace App\Repositories\Implement;

use App\DTO\UserDTO;
use App\EloquentModel\User;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\UserRepository;

class UserRepositoryImp implements UserRepository
{
    protected $user, $mapper;
    public function __construct(User $user, MapperService $mapper)
    {
        $this->user = $user;
        $this->mapper = $mapper;
    }
    public function getOne(int $id)
    {
        $user = $this->user->find($id);
        return $this->mapper->map($user, UserDTO::class);
    }
    public function getOneByEmail(string $email): UserDTO
    {
        $user = $this->user->where('email', $email)->first();
        return $this->mapper->map($user, UserDTO::class);
    }
    public function findAll(): array
    {
        $users = $this->user->all();
        return $this->mapper->mapArray($users, UserDTO::class);
    }

    public function updateByDTO(UserDTO $user): UserDTO
    {
        $this->user->fill((array) $user);
        $this->user->password = bcrypt($user->password);
        $this->user->password_bcrypt = $user->password;
        $this->user->exists = true;
        $this->user->update();
        return $this->mapper->map($this->user, UserDTO::class);
    }

    public function updateByContent(array $content): UserDTO
    {
        $this->user->fill((array) $content);
        $this->user->password = bcrypt($content['password']);
        $this->user->password_bcrypt = $content['password'];
        $this->user->exists = true;
        $this->user->update();
        return $this->mapper->map($this->user, UserDTO::class);
    }

    public function delete(UserDTO $user): bool
    {
        $this->user->fill((array) $user);
        $this->user->exists = true;
        $this->user->delete();
        return $this->mapper->map($this->user, UserDTO::class);
    }

    public function save($content): UserDTO
    {
        $this->user->fill($content);
        $this->user->password = bcrypt($content['password']);
        $this->user->password_bcrypt = $content['password'];
        $this->user->save();
        return $this->mapper->map($this->user, UserDTO::class);
    }
}
