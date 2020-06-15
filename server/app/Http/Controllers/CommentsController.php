<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentsRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    protected $comment_service;
    public function __construct(CommentService $comment_service)
    {
        $this->comment_service = $comment_service;
    }
    public function store($post_id, CommentsRequest $request)
    {
        $comment = $this->comment_service->storeComment($post_id, $request->all());
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
