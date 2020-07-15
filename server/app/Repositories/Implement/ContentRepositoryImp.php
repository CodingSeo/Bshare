<?php

namespace App\Repositories\Implement;

use App\Cache\CacheContract;
use App\DTO\ContentDTO;
use App\DTO\ImageDTO;
use App\DTO\PostDTO;
use App\EloquentModel\Content;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\ContentRepository;

class ContentRepositoryImp implements ContentRepository
{
    protected $mapper, $cache;
    public function __construct(MapperService $mapper, CacheContract $cache)
    {
        $this->mapper = $mapper;
        $this->cache = $cache;
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
    public function getImagesByContent(ContentDTO $contentDTO): array
    {
        $images = $this->cache->remember('api.posts.content.images.' . $contentDTO->getId(), 210000, function () use ($contentDTO) {

            $content = new Content();

            $content->id = $contentDTO->getId();

            return $content->images()->get();
        });

        return $this->mapper->mapArray($images, ImageDTO::class);
    }
}
