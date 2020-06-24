<?php

namespace App\DTO;

class PostDTO
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
     * @var CategoryDTO
     */
    public $category;
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
