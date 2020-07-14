<?php

namespace App\Repositories\Implement;

use App\DTO\FileDTO;
use App\DTO\ImageDTO;
use App\EloquentModel\Image;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\ImageRepository;

class ImageRepositoryImp implements ImageRepository
{
    protected $mapper;
    public function __construct(MapperService $mapper)
    {
        $this->mapper = $mapper;
    }
    public function uploadImagesByFileDTO(FileDTO $fileDTO): ImageDTO
    {
        $image = Image::create([
            'filename'=>$fileDTO->getFilename(),
            'bytes'=>$fileDTO->getSize(),
            'mime'=>$fileDTO->getExtension(),
        ]);
        return $this->mapper->map($image, ImageDTO::class);
    }
}
