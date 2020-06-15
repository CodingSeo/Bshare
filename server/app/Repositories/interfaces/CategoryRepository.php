<?php

namespace App\Repositories\Interfaces;

interface CategoryRepository
{
    public function getCategoryByID($category_id);
    public function getPostsByCategory($category);
}
