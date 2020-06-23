<?php

namespace App\DTO;

class CommentDTO
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $post_id;
    /**
     * @var string
     */
    public $body;
    /**
     * @var int
     */
    public $parent_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $updated_at;
}
