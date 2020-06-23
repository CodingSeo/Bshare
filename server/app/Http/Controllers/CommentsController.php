<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentDestoryRequest;
use App\Http\Requests\CommentsRequest;
use App\Http\Requests\CommentsStoreRequest;
use App\Http\Requests\CommentsUpdateRequest;
use App\Services\Interfaces\CommentService;

class CommentsController extends Controller
{
    protected $comment_service, $authUser;
    public function __construct(CommentService $comment_service, JWTAttemptUser $authUser)
    {
        $this->authUser = $authUser;
        $this->comment_service = $comment_service;
    }
    public function store(CommentsStoreRequest $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([
            'body','parent_id','post_id'
        ]);
        $comment = $this->comment_service->storeComment($content,$user);
        return response()->json($comment);
    }

    public function update(CommentsUpdateRequest $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([
            'comment_id','post_id','parent_id','body'
        ]);
        $comment = $this->comment_service->updateComment($content,$user);
        return response()->json($comment);
    }

    public function destroy(CommentDestoryRequest $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([
            'comment_id'
        ]);
        $result = $this->comment_service->deleteComment($content,$user);
        return $result;
    }
}
