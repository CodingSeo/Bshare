<?php

namespace App\Repositories\Interfaces;

use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;

interface PostRepository
{
    public function getOne(int $id): PostDTO;
    public function getFullContent(int $id): PostDTO;
    public function findAll(): array;
    public function updateByDTO(PostDTO $postDTO): bool;
    public function updateByContent(array $post): bool;
    public function delete(PostDTO $content): bool;
    public function save($content, string $user_email): PostDTO;

    public function saveContent(int $postID, array $content): ContentDTO;
    public function updateContent(PostDTO $post, array $content) : bool;

}
