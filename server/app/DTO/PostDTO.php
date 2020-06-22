<?php

namespace App\DTO;

class PostDTO
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $category_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var int
     */
    public $view_count;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $updated_at;
}
