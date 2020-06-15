<?php

namespace App\Repositories;

use App\EloquentModel\Content;
use App\EloquentModel\Post;

class PostRepository
{
    protected $post, $content;
    public function __construct(Post $post, Content $content)
    {
        $this->post = $post;
        $this->content = $content;
    }
    public function getPostById($post_id)
    {
        return $this->post->find($post_id);
    }
    public function savePost(array $post_info)
    {
        $this->post->fill($post_info);
        $this->post->save();
        return $this->post;
    }
    public function getContent($post)
    {
        return $post->content()->first();
    }
    public function getComments($post)
    {
        return $post->comments()->with('replies')->whereNull('parent_id')
            ->latest()->get();
    }
    public function saveContent($post_id, $body)
    {
        $this->content->post_id = $post_id;
        $this->content->text = $body;
        $this->content->save();
        return $this->content;
    }
    public function inceaseViewCount($post)
    {
        $post->view_count++;
        $post->save();
    }
    public function updatePost($post, $post_info)
    {
        return $post->update($post_info);
    }
    public function updateContent($post, $body)
    {
        $post->content()->update([
            'text' => $body
        ]);
        return $this->getContent($post);
    }
    public function deletePost($post)
    {
        return $post->delete();
    }
}
