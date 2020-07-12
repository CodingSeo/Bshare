<?php

namespace App\Repositories\Interfaces;

use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;

interface PostRepository
{
    public function getPost(int $id): PostDTO;
    public function getPostWithCategory(int $id): PostDTO;
    public function getPostWithContent(int $id): PostDTO;
    public function getCommentAndRepliesByPost(PostDTO $postDTO): array;

    public function updatePostByDTO(PostDTO $postDTO): bool;
    public function updateByRequestContent(array $post): bool;
    public function delete(PostDTO $requestContent): bool;
    public function save($requestContent, string $user_email): PostDTO;

    public function getMostViewedPost(int $amount): array;
    public function getMostRecentPost(int $amount): array;
}
