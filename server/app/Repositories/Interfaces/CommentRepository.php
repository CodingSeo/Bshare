<?php

namespace App\Repositories\Interfaces;

use App\DTO\CommentDTO;
use App\DTO\PostDTO;

interface CommentRepository
{
    public function getComment(int $comment_id): CommentDTO;
    public function updateByDTO(CommentDTO $comment): bool;
    public function updateByContent(array $post): bool;
    public function delete(CommentDTO $comment): bool;
    public function save($content, string $user_email): CommentDTO;
}
