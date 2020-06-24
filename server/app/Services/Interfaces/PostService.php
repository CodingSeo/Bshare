<?php

namespace App\Services\Interfaces;

use App\Auth\AuthUser;

interface PostService
{
    public function getPost(array $content): array;
    public function storePost(array $content, AuthUser $user): array;
    public function updatePost(array $content, AuthUser $user): array;
    public function deletePost(array $content, AuthUser $user): bool;
}
