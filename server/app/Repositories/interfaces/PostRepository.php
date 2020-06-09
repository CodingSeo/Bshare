<?php

namespace App\Repositories\interfaces;

use App\DTO\Content\ContentDTO;

interface PostRepository
{
    public function getPostById(ContentDTO $content);
    public function savePost(array $post_info);
    public function getContent($post);
    public function getComments($post);
    public function saveContent($post_id, $body);
    public function inceaseViewCount($post);
    public function updatePost($post, $post_info);
    public function updateContent($post, $body);
    public function deletePost($post);
}
