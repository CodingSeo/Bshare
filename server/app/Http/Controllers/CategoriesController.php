<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CateogriesIndexRequest;
use App\Services\Interfaces\CategoryService;
use App\Transformers\PostTransformer;

class CategoriesController extends Controller
{
    protected $category_service,$transformer;
    public function __construct(CategoryService $category_service, PostTransformer $transformer)
    {
        $this->category_service = $category_service;
        $this->transformer = $transformer;
    }
    public function index(CateogriesIndexRequest $request)
    {
        $content = $request->only(['category_id']);
        $posts = $this->category_service->getPostsWithCategory($content);
        return $this->transformer->withPagination($posts);
    }
}
