<?php

namespace App\Repositories\Implement;

use App\DTO\FileDTO;
use App\EloquentModel\File;
use App\Mapper\MapperService;
use App\Repositories\Interfaces\FileRepository;

class FileRepositoryImp implements FileRepository
{
    protected $File, $mapper;
    public function __construct(MapperService $mapper)
    {
        $this->mapper = $mapper;
    }
    public function getOne(int $id): FileDTO
    {
        $File = File::find($id);
        return $this->mapper->map($File, FileDTO::class);
    }
    public function findAll(): array
    {
        $Files = $this->File->all();
        return $this->mapper->mapArray($Files, FileDTO::class);
    }
    public function updateByDTO(FileDTO $File): bool
    {
        $this->File->fill((array) $File);
        $this->File->exists = true;
        return $this->File->update();
    }
    public function updateByContent(array $content): bool
    {
        $this->File->fill($content);
        $this->File->id = $content['File_id'];
        $this->File->exists = true;
        return $this->File->update();
    }
    public function delete(FileDTO $File): bool
    {
        $this->File->fill((array) $File);
        $this->File->exists = true;
        $result = $this->File->delete();
        return $result;
    }
    //save에 관하여 saveByContent와 saveByDTO를 나누어 작업하는 것이 맞다고 본다.
    public function save($content, string $user_email): FileDTO
    {
        $File = new File();
        $File->fill($content);
        $File->user_id = $user_email;
        $File->save();
        return $this->mapper->map($File, FileDTO::class);
    }
}
