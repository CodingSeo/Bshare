<?php

namespace App\Repositories\Interfaces;

interface EloquentPagingRepository
{
    public function getPaginate(object $content, int $paginate);
}
