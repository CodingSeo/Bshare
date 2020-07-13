<?php

namespace App\Repositories\Implement;

use App\DTO\PostDTO;
use App\EloquentModel\Post;
use App\Cache\CacheContract;
use App\DTO\CommentDTO;
use App\EloquentModel\Comment;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\PostRepository;
use Illuminate\Support\Facades\DB;

class PostRepositoryImp implements PostRepository
{
    protected $mapper;
    protected $cache;
    public function __construct(MapperService $mapper, CacheContract $cache)
    {
        $this->mapper = $mapper;
        $this->cache = $cache;
    }
    public function getPost(int $id): PostDTO
    {
        $post = POST::active()->find($id);
        return $this->mapper->map($post, PostDTO::class);
    }
    public function getPostWithCategory(int $id): PostDTO
    {
        $post = POST::with('category')->active()->find($id);
        return $this->mapper->map($post, PostDTO::class);
    }
    public function getPostWithContent(int $id): PostDTO
    {
        $post = POST::with('content')->active()->find($id);
        return $this->mapper->map($post, PostDTO::class);
    }
    public function getCommentAndRepliesByPost(PostDTO $postDTO): array
    {
        $post = new Post();
        $post->id = $postDTO->getId();
        $comments = $post->comments()->active()->parent()->with('replies')->get();
        return $this->mapper->mapArray($comments, CommentDTO::class);
    }

    public function updatePostByDTO(PostDTO $postDTO): bool
    {
        $result = Post::where('id', $postDTO->getId())->update([
            'title' => $postDTO->getTitle(),
            'view_count' => $postDTO->getView_count(),
        ]);
        return $result;
    }

    public function updateByRequestContent(array $requestContent): bool
    {
        $result = Post::where('id', $requestContent['post_id'])->update(
            ['title' => $requestContent['title']]
        );
        return $result;
    }

    public function delete(PostDTO $postDTO): bool
    {
        $post_id = $postDTO->getId();
        // $result  = Post::where('id', $post_id)->delete();
        $result = DB::transaction(function () use ($post_id) {
            $postUpdateResult = Post::where('id', $post_id)->update([
                'active' => 0,
            ]);
            $commentUpdateResult = Comment::where('post_id', $post_id)->update([
                'active' => 0,
            ]);
            return ($postUpdateResult && $commentUpdateResult);
        });
        return $result;
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

    public function getMostViewedPost(int $amount): array
    {
        $posts = $this->cache->remember('api.posts.mostviewed', 1000, function () use ($amount) {
            return Post::orderBy('view_count', 'desc')
                ->take($amount++)
                ->get();
        });
        return $this->mapper->mapArray($posts, PostDTO::class);
    }

    public function getMostRecentPost(int $amount): array
    {
        $posts = $this->cache->remember('api.posts.mostrecent', 1000, function () use ($amount) {
            return Post::latest()
                ->take($amount++)
                ->get();
        });
        return $this->mapper->mapArray($posts, PostDTO::class);
    }
}
