<?php

namespace App\DTO;

class PostPaginateDTO extends EloquentPaginateDTO
{
    /**
     * @var PostDTO[]
     */
    public $data;
}
