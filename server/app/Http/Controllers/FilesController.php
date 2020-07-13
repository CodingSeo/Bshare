<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\EloquentModel\Attachment;
use App\EloquentModel\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
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
    public function store(FileRequest $request)
    {
        // $user = $this->authUser->getAuthUser();
        // $file = $request->file('file');
        // $name = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        // //attachmentMove
        // $file->move('./', $name);
        // $attachments->each(function ($attachment) use ($article) {
        //     $attachment->article()->associate($article);
        //     $attachment->save();
        // });
        // }

    }

    public function destroy(Request $request)
    {

    }
}
