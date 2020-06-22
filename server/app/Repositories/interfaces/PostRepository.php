<?php

namespace App\Repositories\Interfaces;

interface PostRepository extends EloquentRepository
{
    public function getContent(object $content): object;
    public function getComments(object $content): array;
    public function saveContent(int $post_id, array $content) : object;
    public function updateContent(object $post, array $content) : object;
}
