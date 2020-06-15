<?php

namespace App\Repositories;

use App\EloquentModel\Category;

class CategoryRepository
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function getCategoryByID($category_id)
    {
        return $this->category->find($category_id);
    }
    public function getPostsByCategory($category)
    {
        return $category->posts()->latest()->paginate(5);
    }
}
