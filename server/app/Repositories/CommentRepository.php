<?php

namespace App\Repositories;

use App\EloquentModel\Comment;

class CommentRepository
{
    protected $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function saveComment($post, $request)
    {
        $comment = $post->comments()->create([
            'post_id'=>$post->id,
            'body'=>$request['body'],
        ]);
        return $comment;
    }
    public function getCommentByID($comment_id){
        return $this->comment->find($comment_id);
    }
    public function updateComment($comment, $request){
        return $comment->update($request);
    }
    public function deleteComment($comment){
        return $comment->delete();
    }
}
