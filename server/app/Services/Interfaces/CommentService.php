<?php
namespace App\Services\Interfaces;

interface CommentService{
    public function storeComment(array $request);
    public function updateComment($comment_id,array $request);
    public function deleteComment($comment_id);
}
