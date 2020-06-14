<?php

namespace App\Repositories\Interfaces;

interface EloquentRepository
{
    public function getOne(int $id): object;
    public function findAll(): array;
    public function update(object $content): object;
    public function delete(object $content): object;
    public function save(object $content): object;
}
