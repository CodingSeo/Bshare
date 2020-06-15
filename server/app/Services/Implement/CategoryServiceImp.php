<?php

namespace App\Services\Implement;

use App\Repositories\Interfaces\CategoryRepository;
use App\Services\Interfaces\CategoryService;

class CategoryServiceImp implements CategoryService
{
    protected $category_repository;
    public function __construct(CategoryRepository $category_repository)
    {
        $this->category_repository = $category_repository;
    }
    public function getPostsWithCategory($category_id)
    {
        $category = $this->category_repository->getCategoryByID($category_id);
        if (!$category) {
            return 'no such category';
        }
        $posts = $this->category_repository->getPostsByCategory($category);
        return collect($posts);
    }
}
