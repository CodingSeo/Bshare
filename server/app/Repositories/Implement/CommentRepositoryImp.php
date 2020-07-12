<?php

namespace App\Repositories\Implement;

use App\DTO\CommentDTO;
use App\EloquentModel\Comment;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\CommentRepository;

class CommentRepositoryImp implements CommentRepository
{
    protected $comment, $mapper;
    public function __construct(MapperService $mapper)
    {
        $this->mapper = $mapper;
    }
    public function getComment(int $comment_id): CommentDTO
    {
        $comment  = Comment::find($comment_id);
        return $this->mapper->map($comment, CommentDTO::class);
    }
    public function updateByDTO(CommentDTO $comment): bool
    {
        return Comment::where('id', $comment->comment_id)
            ->update([
                'body' => $comment->body
            ]);
    }
    public function updateByContent(array $content): bool
    {
        return Comment::where('id', $content['comment_id'])
            ->update([
                'body' => $content['body']
            ]);
    }
    public function delete(CommentDTO $comment): bool
    {
        return Comment::where('id', $comment->id)->update([
            'active' => 0
        ]);
        // ->delete();
    }
    public function save($content, string $user_email): CommentDTO
    {
        $comment = new Comment();
        $comment->user_id = $user_email;
        $comment->body = $content['body'];
        $comment->parent_id = $content['parent_id'];
        $comment->post_id = $content['post_id'];
        $comment->save();
        return $this->mapper->map($comment, CommentDTO::class);
    }
}
