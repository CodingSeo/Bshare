<?php

namespace App\Repositories\Interfaces;

use App\DTO\CommentDTO;

interface CommentRepository
{
    public function getOne(int $id): CommentDTO;
    public function findAll(): array;
    public function updateByDTO(CommentDTO $comment): bool;
    public function updateByContent(array $post): bool;
    public function delete(CommentDTO $comment): bool;
    public function save($content, string $user_email): CommentDTO;
}
