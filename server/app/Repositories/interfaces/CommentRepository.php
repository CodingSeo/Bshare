<?php

namespace App\Repositories\Interfaces;

interface CommentRepository
{
    public function saveComment($post, $request);
    public function getCommentByID($comment_id);
    public function updateComment($comment, $request);
    public function deleteComment($comment);
}
