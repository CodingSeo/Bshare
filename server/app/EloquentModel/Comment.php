<?php

namespace App\EloquentModel;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $with=[
        'replies'
    ];
    protected $fillable = [
        'id',
        'body',
        'parent_id',
        'parent_order',
        'post_id',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function replies(){
        return $this->hasMany(Comment::class,'parent_id');
    }
    public function parent(){
        return $this->belongsTo(Comment::class,'id','parent_id');
    }
}
