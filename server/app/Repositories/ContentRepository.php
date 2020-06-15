<?php

namespace App\Repositories;

use App\EloquentModel\Content;
use App\EloquentModel\Post;


class ContentRepository
{
    protected $content;
    public function __construct(Content $content)
    {
        $this->content = $content;
    }
    public function getContentByPostId($post_id)
    {
        return $this->content->wherePostId($post_id);
    }
}
