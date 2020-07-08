<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CateogriesIndexRequest;
use App\Services\Interfaces\CategoryService;
use App\Transformers\PostTransformer;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    protected $category_service, $transformer;
    public function __construct(CategoryService $category_service, PostTransformer $transformer)
    {
        $this->category_service = $category_service;
        $this->transformer = $transformer;
    }
    public function show() : JsonResponse
    {
        $categories = $this->category_service->getAllCategory();
        return response()->json($categories,200,[],JSON_PRETTY_PRINT);
    }
    public function index(CateogriesIndexRequest $request) : JsonResponse
    {
        $content = onlyContent($request,[
            'category_id'
        ]);
        $posts = $this->category_service->getPostsWithCategory($content);
        return $this->transformer->withPagination($posts);
    }
    public function getQnAPosts() : JsonResponse
    {
        $qnaPosts = $this->category_service->getQnAPostsWithCategory();
        return response()->json($qnaPosts,200,[],JSON_PRETTY_PRINT);
    }
}
