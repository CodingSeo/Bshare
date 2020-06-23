<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentDestoryRequest;
use App\Http\Requests\CommentsRequest;
use App\Http\Requests\CommentsStoreRequest;
use App\Http\Requests\CommentsUpdateRequest;
use App\Services\Interfaces\CommentService;

class CommentsController extends Controller
{
    protected $comment_service;
    public function __construct(CommentService $comment_service)
    {
        $this->comment_service = $comment_service;
    }
    public function store(CommentsStoreRequest $request)
    {
        $content = $request->only([
            'body','parent_id','post_id'
        ]);
        $comment = $this->comment_service->storeComment($content);
        return response()->json($comment);
    }

    public function update(CommentsUpdateRequest $request)
    {
        $content = $request->only([
            'comment_id','post_id','parent_id','body'
        ]);
        $comment = $this->comment_service->updateComment($content);
        return response()->json($comment);
    }

    public function destroy(CommentDestoryRequest $request)
    {
        $content = $request->only([
            'comment_id'
        ]);
        $result = $this->comment_service->deleteComment($content);
        return $result;
    }
}
