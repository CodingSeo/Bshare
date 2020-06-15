<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Facades\DB;

class PostService
{
    protected $post_repository;
    public function __construct(PostRepository $post_repository)
    {
        $this->post_repository = $post_repository;
    }
    public function getPost($post_id)
    {
        $post = $this->post_repository->getPostById($post_id);
        if (!$post) return "no post";
        $content = $this->post_repository->getContent($post);
        $comments = $this->post_repository->getComments($post);
        $this->post_repository->inceaseViewCount($post);
        $postWithInfo = collect($post)
            ->merge($content)
            ->union(['comments' => $comments]);
        return $postWithInfo;
    }
    public function storePost(array $post_info)
    {
        DB::beginTransaction();
        $post = $this->post_repository->savePost($post_info);
        $content = $this->post_repository->saveContent($post->id, $post_info['body']);
        DB::commit();
        $postWithContent = collect($post)->merge($content);
        return $postWithContent;
    }
    public function updatePost($post_id, array $post_info)
    {
        $post = $this->post_repository->getPostById($post_id);
        if (!$post) return "no post";
        DB::beginTransaction();
        $post = $this->post_repository->updatePost($post, $post_info);
        $content = $this->post_repository->updateContent($post, $post_info['body']);
        DB::commit();
        $postWithContent = collect($post)->merge($content);
        return $postWithContent;
    }
    public function deletePost($post_id)
    {
        $post = $this->post_repository->getPostById($post_id);
        if (!$post) return "no post";
        $result = $this->post_repository->deletePost($post);
        if (!$result) return 'delete failed';
        return collect($post);
    }
}
