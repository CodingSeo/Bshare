<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentsRequest;
use App\Services\Interfaces\CommentService;

class CommentsController extends Controller
{
    protected $comment_service;
    public function __construct(CommentService $comment_service)
    {
        $this->comment_service = $comment_service;
    }
    public function store(CommentsRequest $request)
    {
        $parent_id = $request->input('parent_id',null);
        $comment = $this->comment_service->storeComment($request->all());
        return $comment;
    }

    public function update($comment_id, CommentsRequest $request)
    {
        $comment = $this->comment_service->updateComment($comment_id,$request->all());
        return $comment;
    }

    public function destroy($comment_id)
    {
        $comment = $this->comment_service->deleteComment($comment_id);
        return $comment;
    }
}
