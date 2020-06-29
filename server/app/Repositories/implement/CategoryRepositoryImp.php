<?php

namespace App\Repositories\Implement;

use App\DTO\CategoryDTO;
use App\DTO\PostDTO;
use App\DTO\PostPaginateDTO;
use App\EloquentModel\Category;
use App\Mapper\MapperService;
use App\Repositories\interfaces\CategoryRepository;

class CategoryRepositoryImp implements CategoryRepository
{
    protected $mapper;
    public function __construct(MapperService $mapper)
    {
        $this->mapper = $mapper;
    }
    public function getAllCategory(): array
    {
        $categories = Category::get();
        return $this->mapper->mapArray($categories, CategoryDTO::class);
    }
    public function getCategoryByID(int $category_id): CategoryDTO
    {
        $category = Category::find($category_id);
        return $this->mapper->map($category, CategoryDTO::class);
    }
    public function getPostsByCategory(CategoryDTO $categoryDTO, int $page = 5): PostPaginateDTO
    {

        // $category->fill((array) $category);
        // $posts = $this->category->posts()->latest()->paginate($page);
        $categoryModel = new Category();
        $categoryModel->id = $categoryDTO->id;
        $postPaginate = $categoryModel->posts()->latest()->paginate($page);
        return $this->mapper->map(collect($postPaginate), PostPaginateDTO::class);
    }
}
