<?php

namespace App\Services\Interfaces;

use App\Auth\AuthUser;
use App\DTO\PostDTO;

interface PostService
{
    public function getPost(array $content): PostDTO;
    public function storePost(array $content, AuthUser $user): PostDTO;
    public function updatePost(array $content, AuthUser $user): bool;
    public function deletePost(array $content, AuthUser $user): bool;
}
