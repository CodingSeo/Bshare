<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Transformers\PostTransformer;

class CategoriesController extends Controller
{
    protected $category_service,$transformer;
    public function __construct(CategoryService $category_service, PostTransformer $transformer)
    {
        $this->category_service = $category_service;
        $this->transformer = $transformer;
    }
    public function index($category_id)
    {
        $posts = $this->category_service->getPostsWithCategory($category_id);
        return $this->transformer->withPagination($posts);
    }
}
