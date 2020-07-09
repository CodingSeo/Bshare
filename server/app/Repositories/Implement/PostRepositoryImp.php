<?php

namespace App\Repositories\Implement;

use App\DTO\CommentDTO;
use App\DTO\ContentDTO;
use App\DTO\PostDTO;
use App\EloquentModel\Content;
use App\EloquentModel\Post;
use App\Cache\CacheContract;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\PostRepository;

class PostRepositoryImp implements PostRepository
{
    protected $mapper;
    protected $cache;
    public function __construct(MapperService $mapper, CacheContract $cache)
    {
        $this->mapper = $mapper;
        $this->cache = cache();
        // $this->cache = $cache;
    }
    public function getFullContent(int $id): PostDTO
    {
        $this->cache->put('t',1);
        $post = $this->cache->remember("api.post.fullcontent.".$id, 1000, function () use ($id) {
            return POST::with('content','comments')->active()->find($id);
        });
        return $this->mapper->map($post, PostDTO::class);;
    }

    public function getOne(int $id): PostDTO
    {
        $post = $this->cache->remember("api.post.". $id, function () use ($id) {
            return POST::find($id);
        });
        return $this->mapper->map($post, PostDTO::class);
    }

    public function getOneWithCategory(int $id): PostDTO
    {
        $post = $this->cache->remember("api.post.withCategory.".$id, function () use ($id) {
            return POST::with('category')->find($id);
        });
        return $this->mapper->map($post, PostDTO::class);
    }

    public function updateByDTO(PostDTO $postDTO): bool
    {
        $result = Post::where('id', $postDTO->id)->update([
            'title' => $postDTO->title,
            'view_count' => $postDTO->view_count,
        ]);
        if ($result) $this->cache->pull('api.posts.' . $postDTO->id);
        return $result;
    }

    public function updateByContent(array $requestContent): bool
    {
        $result = Post::where('id', $requestContent['post_id'])->update(
            ['title' => $requestContent['title']]
        );
        if ($result) $this->cache->pull('api.posts.' . $requestContent['post_id']);
        return $result;
    }

    public function delete(PostDTO $postDTO): bool
    {
        $post_id = $postDTO->id;
        $result  = Post::where('id', $post_id)->delete();
        if ($result) $this->cache->pull('api.post.' . $post_id);
        if ($result) $this->cache->pull('api.post.fullcontent' . $post_id);
        return $result;
    }

    public function save($requestContent, string $user_email): PostDTO
    {
        $post = new Post();
        $post->user_id = $user_email;
        $post->title = $requestContent['title'];
        $post->category_id = $requestContent['category_id'];
        $post->save();
        if ($post->id)  $this->cache->pull("api.category.posts.".$requestContent['category_id']);
        return $this->mapper->map($post, PostDTO::class);
    }

    public function saveContent(int $postID, array $requestContent): ContentDTO
    {
        $postContent = new Content();
        $postContent->post_id = $postID;
        $postContent->body = $requestContent['body'];
        $postContent->save();
        if ($postContent->id) $this->cache->pull('api.posts.' . $postID);
        return $this->mapper->map($postContent, ContentDTO::class);
    }

    public function updateContent(PostDTO $post, array $requestContent): bool
    {

        $result = Content::where('post_id', $post->id)->update([
            'body' => $requestContent['body']
        ]);
        if ($result) $this->cache->pull('api.posts.' . $post->id);
        return $result;
    }

    public function getMostViewedPost(string $amount): array
    {
        $posts = $this->cache->remember('api.posts.mostviewed', function () use ($amount) {
            return Post::orderBy('view_count', 'desc')
                ->take($amount++)
                ->get();
        }, 600);
        return $this->mapper->mapArray($posts, PostDTO::class);
    }

    public function getMostRecentPost(string $amount): array
    {
        $posts = $this->cache->remember('api.posts.mostrecent', function () use ($amount) {
            return Post::latest()
                ->take($amount++)
                ->get();
        }, 600);
        return $this->mapper->mapArray($posts, PostDTO::class);
    }
}
