<?php

namespace App\Repositories\Interfaces;

use App\DTO\ContentDTO;
use App\DTO\PostDTO;

interface ContentRepository
{
    public function updateContent(PostDTO $post, array $requestContent): bool;
    public function saveContent(int $postID, array $requestContent): ContentDTO;
    public function getImagesByContent(ContentDTO $contentDTO): array;
}
