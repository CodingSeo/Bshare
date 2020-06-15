<?php

namespace App\Repositories\Implement;

use App\DTO\CommentsDTO;
use App\DTO\ContentDTO;
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
    public function getOne(int $id): object
    {
        $post = $this->post->find($id);
        return $this->mapper->map($post, PostDTO::class);
    }
    public function findAll(): array
    {
        $posts = $this->post->all();
        return  $this->mapper->mapArray($posts, PostDTO::class);
    }
    public function update(object $content): object
    {
        $this->post->fill((array)$content);
        $this->post->exists=true;
        dd($this->post->update((array)$content));
        // $post = $this->post->find($content->id);
        // $post->update((array)$content);
        // return $this->mapper->map($post, PostDTO::class);
        return $this->mapper->map($this->post, PostDTO::class);
    }
    public function delete(object $content)
    {
        $this->post->fill((array)$content);
        $this->post->exists=true;
        dd($this->post->delete());
        return $this->post->delete();
    }
    public function save($content): object
    {
        $this->post->fill((array) $content);
        $this->post->save();
        return $this->mapper->map($this->post, PostDTO::class);;
    }
    public function getContent(object $content): object
    {
        $this->post->fill((array) $content);
        $content = $this->post->content()->first();
        return $this->mapper->map($content, ContentDTO::class);
    }
    public function getComments(object $content): array
    {
        $this->post->fill((array) $content);
        $comments = $this->post->comments()->with('replies')->whereNull('parent_id')
            ->latest()->get();
        return $this->mapper->mapArray($comments, CommentsDTO::class);
    }
    public function saveContent(int $post_id, array $content) : object
    {
        $this->content->post_id = $post_id;
        $this->content->fill($content);
        $this->content->save();
        return $this->mapper->map($this->content, ContentDTO::class);
    }
    public function updateContent($post, array $content) : object
    {
        $post_content = $this->content->where('post_id',$post->id)->first();
        $post_content->update($content);
        return $this->mapper->map($post_content, ContentDTO::class);
    }
}
