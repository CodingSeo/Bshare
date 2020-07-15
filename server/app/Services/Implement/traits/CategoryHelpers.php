<?php

namespace App\Services\Implement\traits;

use App\DTO\CategoryDTO;

trait CategoryHelpers
{
    public function checkCategoryWritable(CategoryDTO $category)
    {
        if (!$category->getWritable())
        {
            throw new \App\Exceptions\IllegalUserApproach('cannot write a post on this category');
        }
    }
    public function checkCategoryTradeAble(CategoryDTO $category)
    {
        if(!$category->getUse_trade())
        {
            throw new \App\Exceptions\IllegalUserApproach('cannot trade a post on this category');
        }
    }

    public function setTrade_status(CategoryDTO $category)
    {
        $categoryId=$category->getId();
        return ($categoryId===2 || $categoryId===3)? 'ongoing': null;
    }


}
