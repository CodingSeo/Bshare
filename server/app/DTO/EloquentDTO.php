<?php

namespace App\DTO;

use App\DTO\DTO;

class EloquentDTO implements DTO
{
    private $data;
    public static function map($model)
    {
        if($model){
            return new self($model);
        }else return null;
    }
    public function __construct($model)
    {
        $this->data = $model->toArray();
    }
    public function __get($name)
    {
        if (array_key_exists($name, (array) $this->data)) {
            return $this->data[$name];
        } else return null;
    }
}
