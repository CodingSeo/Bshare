<?php

namespace App\Repositories\Implement\Traits;

use App\DTO\FileDTO;

trait Filemapping {
    public function mapToFileDTO($file): FileDTO
    {
        $fileDTO = new FileDTO();
        $fileDTO->setFilename($file->getFilename());
        $fileDTO->setPath($file->getPath());
        $fileDTO->setSize($file->getSize());
        $fileDTO->setExtension($file->getExtension());
        return $fileDTO;
    }
}
