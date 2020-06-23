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
    public function getPostsWithCategory(array $content)
    {
        $category = $this->category_repository->getCategoryByID($content['category_id']);
        if (!$category->id) throw new \App\Exceptions\ModuleNotFound('Category not Found');
        $page = 5;
        $posts = $this->category_repository->getPostsByCategory($category, $page);
        return $posts;
    }
}
