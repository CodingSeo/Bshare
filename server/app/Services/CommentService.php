<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;

class CommentService
{
    protected $comment_repository, $post_repository;
    public function __construct(PostRepository $post_repository, CommentRepository $comment_repository)
    {
        $this->post_repository = $post_repository;
        $this->comment_repository = $comment_repository;
    }
    public function storeComment($post_id, array $request)
    {
        $post = $this->post_repository->getPostById($post_id);
        if (!$post) {
            return 'no post';
        }
        $comment = $this->comment_repository->saveComment($post, $request);
        return $comment;
    }
}
