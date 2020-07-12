<?php

namespace App\Repositories\Implement;

use App\DTO\ContentDTO;
use App\DTO\PostDTO;
use App\EloquentModel\Content;
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

    public function saveContent(int $postID, array $requestContent): ContentDTO
    {
        $postContent = new Content();
        $postContent->post_id = $postID;
        $postContent->body = $requestContent['body'];
        $postContent->save();
        return $this->mapper->map($postContent, ContentDTO::class);
    }
    public function updateContent(PostDTO $post, array $requestContent): bool
    {

        $result = Content::where('post_id', $post->id)->update([
            'body' => $requestContent['body']
        ]);
        return $result;
    }
}
