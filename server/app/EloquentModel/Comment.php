<?php

namespace App\EloquentModel;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
        return $this->hasMany(Comment::class,'parent_id')->active();
    }
    public function parent(){
        return $this->belongsTo(Comment::class,'id','parent_id');
    }
    public function scopeActive($query){
        return $query->where('active',1);
    }
}
