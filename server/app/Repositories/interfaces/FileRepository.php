<?php

namespace App\Repositories\Interfaces;

use App\DTO\FileDTO;

interface FileRepository
{
    public function getOne(int $id): FileDTO;
    public function findAll(): array;
    public function updateByDTO(FileDTO $File): bool;
    public function updateByContent(array $post): bool;
    public function delete(FileDTO $File): bool;
    public function save($content, string $user_email): FileDTO;
}
