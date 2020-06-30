<?php

namespace App\Mapper;

use JsonMapper;

class JSONMapperService implements MapperService
{
    public $mapper;
    public function __construct(JsonMapper $mapper)
    {
        $mapper->bStrictNullTypes = false;
        $mapper->bEnforceMapType = false;
        $this->mapper = $mapper;
    }
    public function map($object, string $path)
    {
        if (!$object) return new $path;
        $object = json_decode($object);
        return $this->mapper->map($object, new $path);
    }
    //something i should get collect
    public function mapArray($object, string $path)
    {
        $array = array();
        if (!$object) return $array;
        if (is_array($object)) $object = json_encode($object);
        $object = json_decode($object);
        foreach ($object as $item) {
            array_push($array, $this->mapper->map($item, new $path));
        }
        return $array;
    }
}
