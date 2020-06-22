<?php

namespace App\Repositories\Implement;

use App\EloquentModel\Comment;
use App\Repositories\interfaces\CommentRepository;

class CommentRepositoryImp implements CommentRepository
{
    protected $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function saveComment($post, $request)
    {
        $parent_id = null;
        if(array_key_exists('parent_id',$request)){
            $parent_id = $request['parent_id'];
        };
        $comment = $post->comments()->create([
            'post_id'=>$post->id,
            'body'=>$request['body'],
            'parent_id'=>$parent_id,
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
