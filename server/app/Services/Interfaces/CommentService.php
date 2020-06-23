<?php
namespace App\Services\Interfaces;

use App\DTO\CommentDTO;

interface CommentService{
    public function storeComment(array $content): CommentDTO;
    public function updateComment(array $content): CommentDTO;
    public function deleteComment(array $content): bool;
}
