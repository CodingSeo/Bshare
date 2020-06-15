<?php

namespace App\Repositories\Interfaces;

interface ContentRepository
{
    public function getContentByPostId($post_id);
}
