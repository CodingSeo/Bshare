<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\Exceptions\IllegalUserApproach;
use App\Repositories\Interfaces\PostRepository;
use App\Services\Interfaces\PostService;
use Illuminate\Support\Facades\DB;

class PostServiceImp implements PostService
{
    protected $post_repository;
    public function __construct(PostRepository $post_repository)
    {
        $this->post_repository = $post_repository;
    }

    public function getPost(array $content): array
    {
        $post = $this->post_repository->getOne($content['post_id']);
        if (!$post->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        $content = $this->post_repository->getContent($post);
        $comments = $this->post_repository->getComments($post);
        //view increased
        $post->view_count++;
        $post = $this->post_repository->updateByDTO($post);
        if (!$post) throw new \App\Exceptions\ModuleNotFound('Post not updated');
        return [
            'post' => $post,
            'content' => $content,
            'comments' => $comments
        ];
    }

    public function storePost(array $content, AuthUser $user) : array
    {
        DB::beginTransaction();
        $post = $this->post_repository->save($content,$user->email);
        if (!$post->id) {
            DB::rollback();
            throw new \App\Exceptions\ModuleNotFound('Post not saved');
        };
        $content = $this->post_repository->saveContent($post->id, $content);
        DB::commit();
        return [
            'post' => $post,
            'content' => $content,
        ];
    }

    public function updatePost(array $content, AuthUser $user) : array
    {
        $post_exit = $this->post_repository->getOne($content['post_id']);
        if (!$post_exit->id) throw new \App\Exceptions\ModuleNotFound('Post do not exist');
        if (strcmp($post_exit->user_id,$user->email)) throw new IllegalUserApproach();
        DB::beginTransaction();
        $post = $this->post_repository->updateByContent($content);
        $content = $this->post_repository->updateContent($post, $content);
        DB::commit();
        return [
            'post' => $post,
            'content' => $content,
        ];
    }

    public function deletePost(array $content, AuthUser $user) : bool
    {
        $post_exit = $this->post_repository->getOne($content['post_id']);
        if (!$post_exit->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        if (strcmp($post_exit->user_id,$user->email)) throw new IllegalUserApproach();
        $delete_result = $this->post_repository->delete($post_exit);
        if (!$delete_result) throw new \App\Exceptions\ModuleNotFound('delete failed');
        return true;
    }
}
