<?php

namespace App\Services\Implement;

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
        $category = $this->category_repository->getCategory($content['category_id']);

        if (!$category->getId()) throw new \App\Exceptions\ModuleNotFound('Category not Found');

        $page = 10;

        $posts = $this->category_repository->getPostsByCategory($category, $page);

        return $posts;
    }
    public function getQnAPostsWithCategory(): array
    {
        $qnaPosts = $this->category_repository->getQnAPostsByID();

        return $qnaPosts;
    }
}
