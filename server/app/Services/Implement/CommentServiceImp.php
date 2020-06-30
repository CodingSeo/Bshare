<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\DTO\CommentDTO;
use App\Exceptions\IllegalUserApproach;
use App\Repositories\Interfaces\CommentRepository;
use App\Repositories\Interfaces\PostRepository;
use App\Services\Interfaces\CommentService;

class CommentServiceImp implements CommentService
{
    protected $comment_repository, $post_repository;
    public function __construct(PostRepository $post_repository, CommentRepository $comment_repository)
    {
        $this->post_repository = $post_repository;
        $this->comment_repository = $comment_repository;
    }

    public function storeComment(array $content, AuthUser $user): CommentDTO
    {
        $post = $this->post_repository->getOne($content['post_id']);
        if (!$post->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        if (array_key_exists('parent_id', $content)) {
            $parent_comment = $this->comment_repository->getOne($content['parent_id']);
            if (!$parent_comment->id) throw new \App\Exceptions\ModuleNotFound('parent_comment not Found');
        }
        $comment = $this->comment_repository->save($content, $user->email);
        return $comment;
    }

    public function updateComment(array $content, AuthUser $user): void
    {
        $comment = $this->comment_repository->getOne($content['comment_id']);
        if (!$comment->id) throw new \App\Exceptions\ModuleNotFound('comment not Found');
        if (strcmp($comment->post_id,$content['post_id'])) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        if (!$comment->user_id) throw new IllegalUserApproach();
        $result = $this->comment_repository->updateByContent($content);
        if(!$result) throw new \App\Exceptions\ModuleNotFound('update failed');

    }

    public function deleteComment(array $content, AuthUser $user): void
    {
        $comment = $this->comment_repository->getOne($content['comment_id']);
        if (!$comment->id) throw new \App\Exceptions\ModuleNotFound('comment not Found');
        if (strcmp($comment->post_id,$content['post_id'])) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        if (!$comment->user_id) throw new IllegalUserApproach();
        $result = $this->comment_repository->delete($comment);
        if (!$result) throw new \App\Exceptions\ModuleNotFound('delete failed');
    }
}
