<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\DTO\PostDTO;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\CommentRepository;
use App\Repositories\Interfaces\ContentRepository;
use App\Repositories\Interfaces\PostRepository;
use App\Services\Implement\traits\CategoryCheckFunctions;
use App\Services\Interfaces\PostService;
use Illuminate\Support\Facades\DB;

class PostServiceImp implements PostService
{
    use CategoryCheckFunctions;

    protected $postRepository;
    protected $categoryRepository;
    protected $commentRepository;
    protected $contentRepository;
    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        CommentRepository $commentRepository,
        ContentRepository $contentRepository
    ) {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->contentRepository = $contentRepository;
    }

    public function getPost(array $requestContent): PostDTO
    {
        $postDTO = $this->postRepository->getPostWithContent($requestContent['post_id']);

        if (!$postDTO->getId()) {
            throw new \App\Exceptions\ModuleNotFound('Post not Found');
        }

        $comments = $this->postRepository->getCommentAndRepliesByPost($postDTO);

        $images = $this->contentRepository->getImagesByContent($postDTO->getContent());

        $postDTO->getContent()->setImages($images);

        $postDTO->setComments($comments);

        $postDTO->setView_count($postDTO->getView_count() + 1);

        $result = $this->postRepository->updatePostByDTO($postDTO);

        if (!$result) {
            throw new \App\Exceptions\ModuleNotUpdated('Post not Update');
        }

        return $postDTO;
    }

    public function storePost(array $requestContent, AuthUser $user): PostDTO
    {
        $category = $this->categoryRepository->getCategory($requestContent['category_id']);

        $this->checkCategoryWritable($category);

        $requestContent['trade_status'] = $this->setTrade_status($category);

        $postDTO = DB::transaction(function () use ($requestContent, $user, $category) {

            $postDTO = $this->postRepository->save($requestContent, $user->email);

            $postContent = $this->contentRepository->saveContent($postDTO->getID(), $requestContent);

            $postDTO->setCategory($category);

            $postDTO->setContent($postContent);

            if ($requestContent['images_info']) {
                $this->postRepository->attachPostwithImage($requestContent['images_info'], $postContent);
            }
            return $postDTO;
        });


        return $postDTO;
    }

    public function updatePost(array $requestContent, AuthUser $user): void
    {
        $post_exit = $this->postRepository->getPostWithCategory($requestContent['post_id']);

        if (!$post_exit->getId()) {
            throw new \App\Exceptions\ModuleNotFound('Post do not exist');
        }

        if (strcmp($post_exit->getUser_id(), $user->email)) {
            throw new \App\Exceptions\IllegalUserApproach();
        }

        $this->checkCategoryWritable($post_exit->getCategory());

        DB::transaction(function () use ($requestContent, $post_exit) {

            $this->postRepository->updateByRequestContent($requestContent);

            $this->contentRepository->updateContent($post_exit, $requestContent);
        });
    }

    public function deletePost(array $requestContent, AuthUser $user): void
    {
        $post_exit = $this->postRepository->getPost($requestContent['post_id']);

        if (!$post_exit->getId()) {
            throw new \App\Exceptions\ModuleNotFound('Post not Found');
        }

        if (strcmp($post_exit->getUser_id(), $user->email)) {
            throw new \App\Exceptions\IllegalUserApproach();
        }

        $delete_result = DB::transaction(function () use ($post_exit) {
            return $this->postRepository->delete($post_exit);
        });

        if (!$delete_result) {
            throw new \App\Exceptions\ModuelNotDeleted('delete failed');
        }
    }

    public function updateTradeInfoPost(array $requestContent, AuthUser $user): void
    {
        $post_exit = $this->postRepository->getPostWithCategory($requestContent['post_id']);

        if (!$post_exit->getId()) {
            throw new \App\Exceptions\ModuleNotFound('Post do not exist');
        }

        if (strcmp($post_exit->getUser_id(), $user->email)) {
            throw new \App\Exceptions\IllegalUserApproach();
        }

        $this->checkCategoryTradeAble($post_exit->getCategory());

        $update_result = $this->postRepository->updateTradeInfoByRequestContent($requestContent);

        if (!$update_result) {
            throw new \App\Exceptions\ModuleNotUpdated('post update failed');
        }
    }


    public function getMostViewedPost(array $requestContent): array
    {
        return $this->postRepository->getMostViewedPost($requestContent['amount']);
    }

    public function getMostMostRecents(array $requestContent): array
    {
        return $this->postRepository->getMostRecentPost($requestContent['amount']);
    }

    public function getRandomPost(): PostDTO
    {
        $category_id = [1, 2, 3];
        $randomPost = $this->postRepository->getRandomPost($category_id);
        return $randomPost;
    }
}
