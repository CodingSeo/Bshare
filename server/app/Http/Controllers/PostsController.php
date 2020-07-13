<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostsAmountRequest;
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
        $requestContent = onlyContent($request, [
            'post_id'
        ]);
        $post = $this->service->getPost($requestContent);
        return $this->transform->transformPost($post);
    }

    public function store(PostsRequestStore $request): JsonResponse
    {
        $user = $this->authUser->getAuthUser();
        $requestContent = onlyContent($request, [
            'title', 'body', 'category_id'
        ]);
        $post = $this->service->storePost($requestContent, $user);
        return $this->transform->transformPost($post);
    }

    public function update(PostsRequestUpdate $request)
    {

        $user = $this->authUser->getAuthUser();
        $requestContent = onlyContent($request, [
            'post_id', 'title', 'body'
        ]);
        $this->service->updatePost($requestContent, $user);
        return response('success');
    }

    public function destroy(PostsRequestIndex $request)
    {
        $user = $this->authUser->getAuthUser();
        $requestContent = onlyContent($request, [
            'post_id'
        ]);
        $this->service->deletePost($requestContent, $user);
        return response('success');
    }

    public function showMostViews(PostsAmountRequest $request): JsonResponse
    {
        $requestContent = onlyContent($request, [
            'amount'
        ]);
        $posts = $this->service->getMostViewedPost($requestContent);
        return $this->transform->transformPosts($posts);
    }

    public function showMostRecents(PostsAmountRequest $request): JsonResponse
    {
        $requestContent = onlyContent($request, [
            'amount'
        ]);
        $posts = $this->service->getMostMostRecents($requestContent);
        return $this->transform->transformPosts($posts);
    }
}
