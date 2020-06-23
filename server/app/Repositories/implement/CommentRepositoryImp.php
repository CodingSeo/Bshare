<?php

namespace App\Repositories\Implement;

use App\DTO\CommentDTO;
use App\EloquentModel\Comment;
use App\Mapper\MapperService;
use App\Repositories\interfaces\CommentRepository;

class CommentRepositoryImp implements CommentRepository
{
    protected $comment, $mapper;
    public function __construct(Comment $comment, MapperService $mapper)
    {
        $this->comment = $comment;
        $this->mapper = $mapper;
    }
    public function getOne(int $id): CommentDTO
    {
        $comment = $this->comment->find($id);
        return $this->mapper->map($comment, CommentDTO::class);
    }
    public function findAll(): array
    {
        $comments = $this->comment->all();
        return $this->mapper->mapArray($comments, CommentDTO::class);
    }
    public function updateByDTO(CommentDTO $comment): CommentDTO
    {
        $this->comment->fill((array) $comment);
        $this->comment->exists = true;
        $this->comment->update();
        return $this->mapper->map($this->comment, CommentDTO::class);
    }
    public function updateByContent(array $content): CommentDTO
    {
        $this->comment->fill($content);
        $this->comment->id = $content['comment_id'];
        $this->comment->exists = true;
        $this->comment->update();
        return $this->mapper->map($this->comment, CommentDTO::class);
    }
    public function delete(CommentDTO $comment): bool
    {
        $this->comment->fill((array) $comment);
        $this->comment->exists = true;
        $result = $this->comment->delete();
        return $result;
    }
    //save에 관하여 saveByContent와 saveByDTO를 나누어 작업하는 것이 맞다고 본다.
    public function save($content,string $user_email): CommentDTO
    {
        $this->comment->fill($content);
        $this->comment->user_id = $user_email;
        $this->comment->save();
        return $this->mapper->map($this->comment, CommentDTO::class);
    }
}
