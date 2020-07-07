<?php

namespace App\EloquentModel;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
