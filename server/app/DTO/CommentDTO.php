<?php

namespace App\DTO;

class CommentDTO
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $body;
    /**
     * @var RepliesDTO[]
     */
    public $replies;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $updated_at;
}
