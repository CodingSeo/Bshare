<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequest;
use App\Http\Requests\PostsRequestIndex;
use App\Http\Requests\PostsRequestUpdate;
use App\Services\Interfaces\PostService;
use App\Transformers\PostTransformer;
use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{
    protected $service;
    protected $transform;

    public function __construct(PostService $service, PostTransformer $transform)
    {
        $this->service = $service;
        $this->transform = $transform;
    }
    public function show(PostsRequestIndex $request)
    {
        $content = $request->only([
            'post_id'
        ]);
        $post_content_comments_array = $this->service->getPost($content);
        return $post_content_comments_array;
        return $this->transform->withItem($post);
    }
    public function store(PostsRequest $request)
    {
        $content = $request->only([
            'title', 'body', 'category_id'
        ]);
        $post_content_array = $this->service->storePost($content);
        return $post_content_array;
        return $this->transform->withItem($post);
    }

    public function update(PostsRequestUpdate $request)
    {
        $content = $request->only([
            'post_id', 'title', 'body', 'category_id'
        ]);
        $post = $this->service->updatePost($content);
        return $post;
    }

    public function destroy(PostsRequestIndex $request)
    {
        $content = $request->only([
            'post_id'
        ]);
        $result = $this->service->deletePost($content);
        return $result;
    }
}
