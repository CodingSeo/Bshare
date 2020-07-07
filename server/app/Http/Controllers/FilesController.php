<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\EloquentModel\Attachment;
use App\EloquentModel\Post;
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
        // if ($request->has('attachments')) {

        // }
        // $file->move(attachment_path(), $name);
        $articleId = $request->input('articleId');
        $attachment = $articleId
            ? Post::findOrFail($articleId)->attachments()->create(['name' => $name])
            : Attachment::create(['name' => $name]);
    }

    public function destroy(Request $request)
    {
        $user = $this->authUser->getAuthUser();
        $content = $request->only([]);
        $this->comment_service->deleteComment($content, $user);
        return response('success');
    }
}
