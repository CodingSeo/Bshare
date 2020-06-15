<?php

namespace App\EloquentModel;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['body'];
    protected $hidden = ['id', 'post_id'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
