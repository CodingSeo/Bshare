<?php

namespace App\Repositories\Interfaces;

interface CategoryRepository
{
    public function getCategoryByID(int $category_id);
    public function getPostsByCategory(object $category, int $page = 5);
}
