<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\DTO\CategoryDTO;
use App\DTO\PostDTO;
use App\Exceptions\IllegalUserApproach;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\PostRepository;
use App\Services\Interfaces\PostService;
use Illuminate\Support\Facades\DB;

class PostServiceImp implements PostService
{
    protected $postRepository;
    protected $categoryRepository;
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getPost(array $content): PostDTO
    {
        $post = $this->postRepository->getFullContent($content['post_id']);
        if (!$post->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        // better way?
        $post->view_count++;
        $result = $this->postRepository->updateByDTO($post);
        if (!$result) throw new \App\Exceptions\ModuleNotFound('Post not updated');
        dd($post);
        return $post;
    }

    public function storePost(array $content, AuthUser $user): PostDTO
    {
        $category = $this->categoryRepository->getCategoryByID($content['category_id']);
        $this->checkCategoryAvaliable($category);
        DB::beginTransaction();
        $post = $this->postRepository->save($content, $user->email);
        if (!$post->id){
            throw new \App\Exceptions\ModuleNotFound('Post not saved');
            DB::rollBack();
        }
        $postContent = $this->postRepository->saveContent($post->id, $content);
        DB::commit();
        $post->category = $category;
        $post->content = $postContent;
        return $post;
    }

    public function updatePost(array $content, AuthUser $user): bool
    {
        $post_exit = $this->postRepository->getOne($content['post_id']);
        if (!$post_exit->id)
            throw new \App\Exceptions\ModuleNotFound('Post do not exist');
        if (strcmp($post_exit->user_id, $user->email))
            throw new IllegalUserApproach();
        $this->checkCategoryAvaliable($post_exit->category);
        //update join?
        DB::beginTransaction();
        $this->postRepository->updateByContent($content);
        $this->postRepository->updateContent($post_exit, $content);
        DB::commit();

        return true;
    }

    public function deletePost(array $content, AuthUser $user): bool
    {
        $post_exit = $this->postRepository->getOne($content['post_id']);
        if (!$post_exit->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        if (strcmp($post_exit->user_id, $user->email)) throw new IllegalUserApproach();
        $delete_result = $this->postRepository->delete($post_exit);
        if (!$delete_result) throw new \App\Exceptions\ModuleNotFound('delete failed');
        return true;
    }

    public function checkCategoryAvaliable(CategoryDTO $category)
    {
        if (!$category->id)
            throw new \App\Exceptions\ModuleNotFound('category not found');
        if (!$category->writable)
            throw new \App\Exceptions\ModuleNotFound('cannot write a post on this category');
    }
}
