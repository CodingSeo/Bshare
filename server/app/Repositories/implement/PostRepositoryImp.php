<?php

namespace App\Repositories\Implement;

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
        $post = POST::with('category', 'content', 'comments')->find($id);
        return $this->mapper->map($post, PostDTO::class);
    }
    public function getOne(int $id): PostDTO
    {
        $post = POST::find($id);
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
        $postModel = new Post();
        $postModel->fill((array) $postDTO);
        $postModel->exists = true;
        return $postModel->update();
    }
    public function updateByContent(array $requestContent): bool
    {
        $postModel = new Post();
        $postModel->id = $requestContent['post_id'];
        $postModel->title = $requestContent['title'];
        return $postModel->update();
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
        $postContent = new Content();
        $postContent = $postContent->where('post_id', $post->id)->first();
        $result = $postContent->update($requestContent);
        return $result;
    }
}
