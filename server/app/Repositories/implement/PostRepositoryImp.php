<?php

namespace App\Repositories\Implement;

use App\DTO\CommentDTO;
use App\DTO\ContentDTO;
use App\DTO\PostDTO;
use App\EloquentModel\Content;
use App\EloquentModel\Post;
use App\Mapper\MapperService;
use App\Repositories\interfaces\PostRepository;

class PostRepositoryImp implements PostRepository
{
    protected $mapper;
    public function __construct(MapperService $mapper)
    {
        $this->mapper = $mapper;
    }
    public function getFullContent(int $id): PostDTO
    {
        $post = POST::with('content', 'comments')->find($id);
        $post->comments = json_decode($post->comments()->with('replies')->whereNull('parent_id')->latest()->get());
        $postDTO = $this->mapper->map($post, PostDTO::class);
        $postDTO->comments = $this->mapper->mapArray($post->comments,CommentDTO::class);
        return $postDTO;
    }
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
              'view_count'=>$postDTO->view_count,
              ]);
    }
    public function updateByContent(array $requestContent): bool
    {
        return Post::where('id', $requestContent['post_id'])
          ->update(['title' => $requestContent['title']]);
    }
    public function delete(PostDTO $postDTO): bool
    {
        Post::where('id', $postDTO->id)
            ->delete();
        return true;
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
        return $this->mapper->map($postContent, ContentDTO::class);
    }
    public function getContent(PostDTO $post): ContentDTO
    {
        $post = new Post();
        $post->fill((array) $post);
        $requestContent = $post->content()->first();
        return $this->mapper->map($requestContent, ContentDTO::class);
    }
    public function updateContent(PostDTO $post, array $requestContent): bool
    {
        return Content::where('post_id', $post->id)
          ->update(['body' => $requestContent['body']]);
    }
}
