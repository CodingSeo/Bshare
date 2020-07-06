<?php

namespace App\Services\Interfaces;

use App\Auth\AuthUser;
use App\DTO\FileDTO;

interface FileService
{
    public function storeFile(array $requestContent, AuthUser $user): FileDTO;
    public function updateFile(array $requestContent, AuthUser $user): void;
    public function deleteFile(array $requestContent, AuthUser $user): void;
}
