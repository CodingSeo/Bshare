<?php

namespace App\Services\Interfaces;

use App\Auth\AuthUser;
use App\DTO\ImageDTO;

interface ImageService
{
    public function uploadImages(array $requestContent): ImageDTO;
    public function updateImages(array $requestContent, AuthUser $user): void;
    public function deleteImages(array $requestContent, AuthUser $user): void;
}
