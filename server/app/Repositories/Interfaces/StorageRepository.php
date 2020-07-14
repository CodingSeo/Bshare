<?php

namespace App\Repositories\Interfaces;

use App\DTO\FileDTO;

interface StorageRepository
{
    public function save(string $path,string $array_name, array $requestContent) : FileDTO;
}
