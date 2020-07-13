<?php

namespace App\Services\Implement\traits;

use App\DTO\CategoryDTO;

trait CategoryHelpers
{
    public function checkCategoryAvaliable(CategoryDTO $category)
    {
        if (!$category->getId())
        {
            throw new \App\Exceptions\ModuleNotFound('category not found');
        }

        if (!$category->getWritable())
        {
            throw new \App\Exceptions\IllegalUserApproach('cannot write a post on this category');
        }
    }

    public function setTrade_status(CategoryDTO $category)
    {
        $categoryId=$category->getId();
        return ($categoryId===2 || $categoryId===3)? 'ongoing': null;
    }


}
