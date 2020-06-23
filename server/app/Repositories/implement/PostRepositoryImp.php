<?php

namespace App\Repositories\Implement;

use App\DTO\ContentDTO;
use App\DTO\PostCommentsDTO;
use App\DTO\PostDTO;
use App\EloquentModel\Content;
use App\EloquentModel\Post;
use App\Mapper\MapperService;
use App\Repositories\interfaces\PostRepository;

class PostRepositoryImp implements PostRepository
{
    protected $post, $content, $mapper;
    public function __construct(Post $post, Content $content, MapperService $mapper)
    {
        $this->post = $post;
        $this->content = $content;
        $this->mapper = $mapper;
    }
    public function getOne(int $id): PostDTO
    {
        $post = $this->post->find($id)->where('active', 1);
        dd($post);
        return $this->mapper->map($post, PostDTO::class);
    }
    public function findAll(): array
    {
        $posts = $this->post->all();
        return  $this->mapper->mapArray($posts, PostDTO::class);
    }
    public function updateByDTO(PostDTO $post): PostDTO
    {
        $this->post->fill((array) $post);
        $this->post->exists = true;
        $this->post->update();
        return $this->mapper->map($this->post, PostDTO::class);
    }
    public function updateByContent(array $content): PostDTO
    {
        $this->post->fill($content);
        $this->post->id = $content['post_id'];
        $this->post->exists = true;
        $this->post->update();
        return $this->mapper->map($this->post, PostDTO::class);
    }
    public function delete(PostDTO $content): bool
    {
        $this->post->fill((array) $content);
        $this->post->exists = true;
        $result = $this->post->delete();
        return $result;
    }
    public function save($content): PostDTO
    {
        $this->post->fill((array) $content);
        $this->post->save();
        return $this->mapper->map($this->post, PostDTO::class);;
    }
    public function getContent(PostDTO $post): ContentDTO
    {
        $this->post->fill((array) $post);
        $content = $this->post->content()->first();
        return $this->mapper->map($content, ContentDTO::class);
    }
    public function getComments(PostDTO $post): array
    {
        $this->post->fill((array) $post);
        $comments = $this->post->comments()->with('replies')->whereNull('parent_id')
            ->latest()->get();
        return $this->mapper->mapArray($comments, PostCommentsDTO::class);
    }
    public function saveContent(int $post_id, array $content): ContentDTO
    {
        $this->content->post_id = $post_id;
        $this->content->fill($content);
        $this->content->save();
        return $this->mapper->map($this->content, ContentDTO::class);
    }
    public function updateContent(PostDTO $post, array $content): ContentDTO
    {
        $post_content = $this->content->where('post_id', $post->id)->first();
        $post_content->update($content);
        return $this->mapper->map($post_content, ContentDTO::class);
    }
}
