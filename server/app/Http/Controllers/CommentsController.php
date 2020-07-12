<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentDestoryRequest;
use App\Http\Requests\CommentsRequest;
use App\Http\Requests\CommentsStoreRequest;
use App\Http\Requests\CommentsUpdateRequest;
use App\Services\Interfaces\CommentService;
use App\Transformers\PostTransformer;


class CommentsController extends Controller
{
    protected $comment_service, $authUser, $transform;
    public function __construct(CommentService $comment_service, JWTAttemptUser $authUser, PostTransformer $transform)
    {
        $this->authUser = $authUser;
        $this->comment_service = $comment_service;
        $this->transform = $transform;
    }
    public function store(CommentsStoreRequest $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = onlyContent($request, [
            'body', 'parent_id', 'post_id'
        ]);
        $comment = $this->comment_service->storeComment($content, $user);
        return $this->transform->transformComment($comment);
    }

    public function update(CommentsUpdateRequest $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = onlyContent($request, [
            'comment_id', 'parent_id', 'body'
        ]);
        $this->comment_service->updateComment($content, $user);
        return response('success');
    }

    public function destroy(CommentDestoryRequest $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = onlyContent($request, [
            'comment_id'
        ]);
        $this->comment_service->deleteComment($content, $user);
        return response('success');
    }
}
