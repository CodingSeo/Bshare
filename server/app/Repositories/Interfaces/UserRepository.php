<?php

namespace App\Repositories\Interfaces;

use App\DTO\UserDTO;

interface UserRepository
{
    public function getOne(int $id);
    public function getOneByEmail(string $email): UserDTO;
    public function getOneOrCreateByEmail(array $user_info): UserDTO;
    public function delete(UserDTO $content): bool;
    public function save($content): UserDTO;
}
