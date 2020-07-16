<?php

namespace App\EloquentModel;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $fillable = [
        'filename', 'bytes', 'mime', 'id', 'filepath'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
