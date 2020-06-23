<?php

namespace App\Repositories\Interfaces;

use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;

interface PostRepository
{
    public function getOne(int $id): PostDTO;
    public function findAll(): array;
    public function updateByDTO(PostDTO $post): PostDTO;
    public function updateByContent(array $post): PostDTO;
    public function delete(PostDTO $content): bool;
    public function save($content): PostDTO;

    public function getContent(PostDTO $post): ContentDTO;
    public function getComments(PostDTO $post): array;
    public function saveContent(int $post_id, array $content) : ContentDTO;
    public function updateContent(PostDTO $post, array $content) : ContentDTO;
}
