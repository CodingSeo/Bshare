<?php

namespace App\Repositories\Implement;

use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;
use App\EloquentModel\Content;
use App\EloquentModel\Post;
use App\Mapper\MapperService;
use App\Repositories\interfaces\PostRepository;
use Illuminate\Support\Facades\DB;

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
        \DB::connection()->enableQueryLog();
        $post = POST::find($id);
        // $post = POST::find($id)->content();
        $queries = \DB::getQueryLog();
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
        $postModel->exists=true;
        return $postModel->update();
    }
    public function updateByContent(array $content): bool
    {
        $postModel = new Post();
        $postModel->id = $content['post_id'];
        $postModel->title = $content['title'];
        return $postModel->update();
    }
    public function delete(PostDTO $postDTO): bool
    {
        Post::where('id', $postDTO->id)
            ->delete();
        return true;
    }
    public function save($content, string $user_email): PostDTO
    {
        $post = new Post();
        $post->user_id = $user_email;
        $post->title = $content['title'];
        $post->category_id = $content['category_id'];
        $post->save();
        return $this->mapper->map($post, PostDTO::class);
    }

    public function saveContent(int $postID, array $content): ContentDTO
    {
        $postContent = new Content();
        $postContent->post_id = $postID;
        $postContent->body = $content['body'];
        $postContent->save();
        return $this->mapper->map($postContent, ContentDTO::class);
    }
    public function getContent(PostDTO $post): ContentDTO
    {
        $post = new Post();
        $post->fill((array) $post);
        $content = $post->content()->first();
        return $this->mapper->map($content, ContentDTO::class);
    }
    public function updateContent(PostDTO $post, array $content): bool
    {
        $postContent = new Content();
        $postContent = $postContent->where('post_id', $post->id)->first();
        $result = $postContent->update($content);
        return $result;
    }
}
