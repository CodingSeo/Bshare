<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Content;

class Post extends Model
{
    protected $fillable = ['category_id','title'];
    protected $hidden =['id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function content(){
        return $this->hasOne(Content::class);
    }
}
