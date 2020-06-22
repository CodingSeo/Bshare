<?php

namespace App\Services\Interfaces;

interface PostService
{
    public function getPost(array $content) :array;
    public function storePost(array $content) : array;
    public function updatePost(array $content);
    public function deletePost(array $content);
}
