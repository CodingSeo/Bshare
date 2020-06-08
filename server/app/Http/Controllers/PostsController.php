<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    protected $service;
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
    public function show($post_id)
    {
        $post = $this->service->getPost($post_id);
        return $post;
    }

    public function store(PostsRequest $request)
    {
        $post = $this->service->storePost($request->all());
        return $post;
    }

    public function update($post_id, PostsRequest $request)
    {
        //Eloquent
        $post = $this->service->updatePost($post_id, $request->all());
        return $post;
    }

    public function destroy($post_id)
    {
        //Eloquent
        $post = $this->service->deletePost($post_id);
        return $post;
    }
}
