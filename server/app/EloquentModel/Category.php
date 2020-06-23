<?php

namespace App\EloquentModel;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = [
        'id'
    ];
    public $timestamps = false;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
