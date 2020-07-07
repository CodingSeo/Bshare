<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\DTO\CategoryDTO;
use App\DTO\PostDTO;
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

    public function getPost(array $requestContent): PostDTO
    {
        $post = $this->postRepository->getFullContent($requestContent['post_id']);
        if (!$post->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        $post->view_count++;
        $result = $this->postRepository->updateByDTO($post);
        if (!$result) throw new \App\Exceptions\ModuleNotUpdated('Post not Update');
        return $post;
    }

    public function storePost(array $requestContent, AuthUser $user): PostDTO
    {
        $category = $this->categoryRepository->getCategoryByID($requestContent['category_id']);
        $this->checkCategoryAvaliable($category);
        $post = DB::transaction(function () use($requestContent,$user,$category) {
            $post = $this->postRepository->save($requestContent, $user->email);
            $postContent = $this->postRepository->saveContent($post->id, $requestContent);
            $post->category = $category;
            $post->content = $postContent;
            if (!$post->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
            return $post;
        });
        return $post;
    }

    public function updatePost(array $requestContent, AuthUser $user): void
    {
        $post_exit = $this->postRepository->getOneWithCategory($requestContent['post_id']);
        if (!$post_exit->id) throw new \App\Exceptions\ModuleNotFound('Post do not exist');
        if (strcmp($post_exit->user_id, $user->email)) throw new \App\Exceptions\IllegalUserApproach();
        $this->checkCategoryAvaliable($post_exit->category);
        DB::beginTransaction();
        $this->postRepository->updateByContent($requestContent);
        $this->postRepository->updateContent($post_exit, $requestContent);
        DB::commit();
    }

    public function deletePost(array $requestContent, AuthUser $user): void
    {
        $post_exit = $this->postRepository->getOne($requestContent['post_id']);
        if (!$post_exit->id) throw new \App\Exceptions\ModuleNotFound('Post not Found');
        if (strcmp($post_exit->user_id, $user->email)) throw new \App\Exceptions\IllegalUserApproach();
        $delete_result = $this->postRepository->delete($post_exit);
        if (!$delete_result) throw new \App\Exceptions\ModuelNotDeleted('delete failed');
    }

    public function getMostViewedPost(array $requestContent): array
    {
        $posts = $this->postRepository->getMostViewedPost($requestContent['amount']);
        return $posts;
    }

    public function getMostMostRecents(array $requestContent): array
    {
        $posts = $this->postRepository->getMostRecentPost($requestContent['amount']);
        return $posts;
    }

    public function checkCategoryAvaliable(CategoryDTO $category)
    {
        if (!$category->id)
            throw new \App\Exceptions\ModuleNotFound('category not found');
        if (!$category->writable)
            throw new \App\Exceptions\IllegalUserApproach('cannot write a post on this category');
    }
}
