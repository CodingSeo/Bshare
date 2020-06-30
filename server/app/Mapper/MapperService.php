<?php

namespace App\Mapper;

interface MapperService
{
    public function map($object, string $path);
    public function mapArray($object, string $path);
}
