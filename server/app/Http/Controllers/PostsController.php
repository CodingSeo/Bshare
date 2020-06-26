<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequestIndex;
use App\Http\Requests\PostsRequestStore;
use App\Http\Requests\PostsRequestUpdate;
use App\Services\Interfaces\PostService;
use App\Transformers\PostTransformer;
use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{
    protected $service;
    protected $transform;
    protected $authUser;

    public function __construct(PostService $service, PostTransformer $transform, JWTAttemptUser $authUser)
    {
        $this->authUser = $authUser;
        $this->service = $service;
        $this->transform = $transform;
    }

    public function show(PostsRequestIndex $request): JsonResponse
    {
        $content = $request->only([
            'post_id'
        ]);
        $post = $this->service->getPost($content);
        return $this->transform->transformPost($post);
    }

    public function store(PostsRequestStore $request): JsonResponse
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([
            'title', 'body', 'category_id'
        ]);
        $post = $this->service->storePost($content, $user);
        return $this->transform->transformPost($post);
    }

    public function update(PostsRequestUpdate $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([
            'post_id', 'title', 'body'
        ]);
        $this->service->updatePost($content, $user);
        return response('success');
    }

    public function destroy(PostsRequestIndex $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([
            'post_id'
        ]);
        $this->service->deletePost($content, $user);
        return response('success');
    }
}
