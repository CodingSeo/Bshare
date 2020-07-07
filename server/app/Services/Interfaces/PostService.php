<?php

namespace App\Services\Interfaces;

use App\Auth\AuthUser;
use App\DTO\PostDTO;

interface PostService
{
    public function getPost(array $requestContent): PostDTO;
    public function storePost(array $requestContent, AuthUser $user): PostDTO;
    public function updatePost(array $requestContent, AuthUser $user): void;
    public function deletePost(array $requestContent, AuthUser $user): void;
    public function getMostViewedPost(array $requestContent): array;
    public function getMostMostRecents(array $requestContent): array;
}
