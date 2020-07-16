<?php

namespace App\Repositories\Interfaces;

use App\DTO\FileDTO;
use App\DTO\ImageDTO;

interface ImageRepository
{
    public function uploadImagesByFileDTO(FileDTO $fileDTO): ImageDTO;
}
