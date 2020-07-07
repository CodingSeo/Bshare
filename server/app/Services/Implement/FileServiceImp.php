<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\DTO\FileDTO;
use App\Repositories\Interfaces\FileRepository;
use App\Repositories\Interfaces\PostRepository;
use App\Services\Interfaces\FileService;

class FileServiceImp implements FileService
{
    protected $File_repository, $post_repository;
    public function __construct(PostRepository $post_repository, FileRepository $File_repository)
    {
        $this->post_repository = $post_repository;
        $this->File_repository = $File_repository;
    }

    public function storeFile(array $content, AuthUser $user): FileDTO
    {
        $attachments = Attachment::whereIn('id', $request->input('attachments'))->get();
        $attachments->each(function($attachment) use($article) {
            $attachment->article()->associate($article);
            $attachment->save();
        });
    }

    public function updateFile(array $content, AuthUser $user): void
    {

    }

    public function deleteFile(array $content, AuthUser $user): void
    {

    }
}
