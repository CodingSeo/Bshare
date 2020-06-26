<?php

namespace App\Repositories\Interfaces;

use App\DTO\CategoryDTO;
use App\DTO\PostPaginateDTO;

interface CategoryRepository
{
    public function getCategoryByID(int $category_id): CategoryDTO;
    public function getPostsByCategory(CategoryDTO $category, int $page = 5): PostPaginateDTO;
}
