<?php

namespace App\Repositories\Implement;

use App\Cache\CacheContract;
use App\DTO\CategoryDTO;
use App\DTO\PostDTO;
use App\DTO\PostPaginateDTO;
use App\EloquentModel\Category;
use App\EloquentModel\Post;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\CategoryRepository;

class CategoryRepositoryImp implements CategoryRepository
{
    protected $mapper;
    protected $cache;
    public function __construct(MapperService $mapper, CacheContract $cache)
    {
        $this->mapper = $mapper;
        $this->cache = $cache;
    }
    public function getAllCategory(): array
    {
        $categories = $this->cache->remember("api.categories", null, function () {
            return Category::get();
        });
        return $this->mapper->mapArray($categories, CategoryDTO::class);
    }
    public function getCategory(int $category_id): CategoryDTO
    {
        $category = $this->cache->remember("api.category." . $category_id, null, function () use ($category_id) {
            return Category::find($category_id);
        });
        return $this->mapper->map($category, CategoryDTO::class);
    }
    public function getPostsByCategory(CategoryDTO $categoryDTO, int $page = 5): PostPaginateDTO
    {
        $postPaginate = $this->cache->remember("api.category.posts." . $categoryDTO->id, null, function () use ($categoryDTO, $page) {
            $categoryModel = new Category();
            $categoryModel->id = $categoryDTO->id;
            return $categoryModel->posts()->latest()->paginate($page);
        });
        return $this->mapper->map(collect($postPaginate), PostPaginateDTO::class);
    }
    public function getQnAPostsByID(): array
    {
        $posts = $this->cache->remember('category/qna', null, function () {
            return Post::with('content')->where('category_id', 4)->get();
        });
        return $this->mapper->mapArray($posts, PostDTO::class);
    }
}
