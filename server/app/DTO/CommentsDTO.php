<?php

namespace App\DTO;

class CommentsDTO
{
    /**
     * @var string
     */
    public $body;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $updated_at;
    /**
     * @var array
     */
    public $replies;
}
