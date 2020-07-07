<?php

namespace App\Services\Implement;

use App\Cache\CacheContract;
use App\DTO\PostDTO;
use App\DTO\PostPaginateDTO;
use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Interfaces\CategoryService;

class CategoryServiceImp implements CategoryService
{
    protected $category_repository;
    public function __construct(CategoryRepository $category_repository)
    {
        $this->category_repository = $category_repository;
    }
    public function getAllCategory(): array
    {
        return $this->category_repository->getAllCategory();
    }
    public function getPostsWithCategory(array $content): PostPaginateDTO
    {
        $category = $this->category_repository->getCategoryByID($content['category_id']);
        if (!$category->id) throw new \App\Exceptions\ModuleNotFound('Category not Found');
        $page = 5;
        $posts = $this->category_repository->getPostsByCategory($category, $page);
        return $posts;
    }
    public function getQnAPostsWithCategory(): array
    {
        $qnaPosts = $this->category_repository->getQnAPostsByID();
        if (!$qnaPosts[0]->id) throw new \App\Exceptions\ModuleNotFound('Category not Found');
        return $qnaPosts;
    }
}
