<?php

namespace App\Repositories\Interfaces;

use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;

interface PostRepository
{
    public function getOne(int $id): PostDTO;
    public function getOneWithCategory(int $id): PostDTO;
    public function getFullContent(int $id): PostDTO;

    public function updateByDTO(PostDTO $postDTO): bool;
    public function updateByContent(array $post): bool;
    public function delete(PostDTO $requestContent): bool;
    public function save($requestContent, string $user_email): PostDTO;
    public function saveContent(int $postID, array $requestContent): ContentDTO;
    public function updateContent(PostDTO $post, array $requestContent): bool;

    public function getMostViewedPost(string $amount): array;
    public function getMostRecentPost(string $amount): array;
}
