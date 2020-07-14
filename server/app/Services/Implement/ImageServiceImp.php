<?php

namespace App\Services\Implement;

use App\Auth\AuthUser;
use App\DTO\ImageDTO;
use App\Repositories\Interfaces\ImageRepository;
use App\Repositories\Interfaces\StorageRepository;
use App\Services\Interfaces\ImageService;

class ImageServiceImp implements ImageService
{
    protected $imageRepository, $storageRepository;
    public function __construct(ImageRepository $imageRepository, StorageRepository $storageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->storageRepository = $storageRepository;
    }

    public function uploadImages(array $requestContent): ImageDTO
    {
        $fileDTO = $this->storageRepository->save('images','image',$requestContent);
        $imageDTO = $this->imageRepository->uploadImagesByFileDTO($fileDTO);
        return new ImageDTO();
    }
    public function updateImages(array $requestContent, AuthUser $user): void
    {

    }
    public function deleteImages(array $requestContent, AuthUser $user): void
    {

    }
}
