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
    protected $category, $mapper;
    public function __construct(Category $category, MapperService $mapper)
    {
        $this->category = $category;
        $this->mapper = $mapper;
    }
    public function getCategoryByID(int $category_id)
    {
        $category  = $this->category->find($category_id);
        return $this->mapper->map($category, CategoryDTO::class);
    }
    public function getPostsByCategory(object $category, int $page = 5) : PostPaginateDTO
    {
        $this->category->fill((array) $category);
        $posts = $this->category->posts()->latest()->paginate($page);
        return $this->mapper->mapPaginate(collect($posts), PostPaginateDTO::class, PostDTO::class);
    }
}
