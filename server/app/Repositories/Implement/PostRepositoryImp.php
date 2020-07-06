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
        $this->cache = $cache;
    }
    public function getFullContent(int $id): PostDTO
    {
        $post = $this->cache->remember("api.post.".$id, function () use ($id) {
            $post = POST::with('content')->find($id);
            $post->comments = $post->comments()->with('replies')->whereNull('parent_id')->latest()->get();
            return $post;
        });
        $postDTO = $this->mapper->map($post, PostDTO::class);
        $postDTO->comments = $this->mapper->mapArray(json_decode($post->comments), CommentDTO::class);
        return $postDTO;
    }
    // public function getFullContent(int $id): PostDTO
    // {
    //     // $post = $this->cache->remember($requestContent['cache_key'], function () use ($requestContent) {
    //     // });
    //     $cache_required = array();
    //     $cached_post = $this->cache->getMulti([`api.posts.$id`,`api.comments.$id`,`api.content.$id`]);
    //     $post_model = new Post();
    //     if($cached_post[`api.posts.$id`]){
    //         $post_model->where('id',$id);
    //     }
    //     if($cached_post[`api.comments.$id`]){
    //         $post_model->with('content');
    //     }
    //     if($cached_post[`api.content.$id`]){
    //         $comments = json_decode($post_model->comments()->with('replies')->whereNull('parent_id')->latest()->get());
    //     }
    //     $post = POST::with('content')->find($id);
    //     $comments = json_decode($post->comments()->with('replies')->whereNull('parent_id')->latest()->get());
    //     $postDTO = $this->mapper->map($post, PostDTO::class);
    //     $postDTO->comments = $this->mapper->mapArray($comments, CommentDTO::class);
    //     return $postDTO;
    // }
    public function getOne(int $id): PostDTO
    {
        $post = POST::find($id);
        return $this->mapper->map($post, PostDTO::class);
    }
    public function getOneWithCategory(int $id): PostDTO
    {
        $post = POST::with('category')->find($id);
        return $this->mapper->map($post, PostDTO::class);
    }
    //*
    public function findAll(): array
    {
        $posts = Post::all();
        return  $this->mapper->mapArray($posts, PostDTO::class);
    }
    public function updateByDTO(PostDTO $postDTO): bool
    {
        return Post::where('id', $postDTO->id)
            ->update([
                'title' => $postDTO->title,
                'view_count' => $postDTO->view_count,
            ]);
    }
    public function updateByContent(array $requestContent): bool
    {
        return Post::where('id', $requestContent['post_id'])
            ->update(['title' => $requestContent['title']]);
    }
    public function delete(PostDTO $postDTO): bool
    {
        return Post::where('id', $postDTO->id)
            ->delete();
    }
    public function save($requestContent, string $user_email): PostDTO
    {
        $post = new Post();
        $post->user_id = $user_email;
        $post->title = $requestContent['title'];
        $post->category_id = $requestContent['category_id'];
        $post->save();
        return $this->mapper->map($post, PostDTO::class);
    }

    public function saveContent(int $postID, array $requestContent): ContentDTO
    {
        $postContent = new Content();
        $postContent->post_id = $postID;
        $postContent->body = $requestContent['body'];
        $postContent->save();
        $this->cache->destroy('api.posts'.$postID);
        return $this->mapper->map($postContent, ContentDTO::class);
    }
    public function updateContent(PostDTO $post, array $requestContent): bool
    {
        $this->cache->destroy('api.posts'.$post->id);
        return Content::where('post_id', $post->id)
            ->update(['body' => $requestContent['body']]);
    }
    public function getMostViewedPost(string $amount): array
    {
        $posts = $this->cache->remember('api.posts.mostviewed', function () use ($amount) {
            return Post::orderBy('view_count', 'desc')
                ->take($amount++)
                ->get();
        },600);
        return $this->mapper->mapArray($posts, PostDTO::class);
    }
    public function getMostRecentPost(string $amount): array
    {
        $posts = $this->cache->remember('api.posts.mostrecent', function () use ($amount) {
            return Post::latest()
                ->take($amount)
                ->get();
        },600);
        return $this->mapper->mapArray($posts, PostDTO::class);
    }
}
