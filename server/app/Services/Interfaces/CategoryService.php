<?php

namespace App\Services\Interfaces;

interface CategoryService
{
    public function getPostsWithCategory($category_id);
}
