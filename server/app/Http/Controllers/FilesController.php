<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\CommentService;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    protected $comment_service, $authUser, $transform;
    public function __construct(JWTAttemptUser $authUser, PostTransformer $transform)
    {
        $this->authUser = $authUser;
        $this->transform = $transform;
    }
    public function store(Request $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([

        ]);
        $comment = $this->comment_service->storeComment($content,$user);
        return $this->transform->transformComment($comment);
    }

    public function update(Request $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([

        ]);
        $this->comment_service->updateComment($content,$user);
        return response('success');
    }

    public function destroy(Request $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([

        ]);
        $this->comment_service->deleteComment($content,$user);
        return response('success');
    }
}
