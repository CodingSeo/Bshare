<?php
namespace App\Services\Interfaces;

use App\Auth\AuthUser;
use App\DTO\CommentDTO;

interface CommentService{
    public function storeComment(array $content, AuthUser $user): CommentDTO;
    public function updateComment(array $content, AuthUser $user): CommentDTO;
    public function deleteComment(array $content, AuthUser $user): bool;
}
