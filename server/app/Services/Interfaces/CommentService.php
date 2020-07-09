<?php
namespace App\Services\Interfaces;

use App\Auth\AuthUser;
use App\DTO\CommentDTO;
use App\DTO\PostDTO;

interface CommentService{
    public function getCommentWithReplies(PostDTO $postDTO): array;
    public function storeComment(array $content, AuthUser $user): CommentDTO;
    public function updateComment(array $content, AuthUser $user): void;
    public function deleteComment(array $content, AuthUser $user): void;
}
