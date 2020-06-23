<?php

namespace App\Repositories\Interfaces;

interface EloquentRepository
{
    public function getOne(int $id);
    public function findAll(): array;
    public function updateByDTO($content);
    public function updateByContent(array $content);
    public function delete(object $content): bool;
    public function save($content): object;
}
