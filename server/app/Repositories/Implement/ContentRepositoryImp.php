<?php

namespace App\Repositories\Implement;

use App\EloquentModel\Content;
use App\EloquentModel\Post;
use App\Repositories\Interfaces\ContentRepository;

class ContentRepositoryImp implements ContentRepository
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
