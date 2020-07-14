<?php

namespace App\Repositories\Implement;

use App\Mapper\MapperService;
use App\DTO\FileDTO;
use App\Repositories\Implement\Traits\Filemapping;
use App\Repositories\Interfaces\StorageRepository;

class StorageRepositoryImp implements StorageRepository
{
    use Filemapping;
    protected $mapperService;
    public function __construct(MapperService $mapperService)
    {
        $this->mapperService  = $mapperService;
    }
    public function save(string $path,string $array_name, array $requestContent) : FileDTO
    {
        $file = $requestContent[$array_name];
        $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $fileResult = $file->move(public_path($path), $fileName);
        $fileDTO = $this->mapToFileDTO($fileResult);
        return $fileDTO;
    }

}
