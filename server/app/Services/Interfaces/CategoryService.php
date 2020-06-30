<?php

namespace App\Services\Interfaces;

use App\DTO\PostPaginateDTO;

interface CategoryService
{
    public function getAllCategory(): array;
    public function getPostsWithCategory(array $content): PostPaginateDTO;
}
