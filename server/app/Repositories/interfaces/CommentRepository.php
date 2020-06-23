<?php

namespace App\Repositories\Interfaces;

use App\DTO\CommentDTO;

interface CommentRepository
{
    public function getOne(int $id): CommentDTO;
    public function findAll(): array;
    public function updateByDTO(CommentDTO $comment): CommentDTO;
    public function updateByContent(array $post): CommentDTO;
    public function delete(CommentDTO $comment): bool;
    public function save($content): CommentDTO;
}
