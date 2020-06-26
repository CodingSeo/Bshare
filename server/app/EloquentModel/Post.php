<?php

namespace App\EloquentModel;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'id',
        'view_count', 'created_at', 'updated_at'
    ];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function content()
    {
        return $this->hasOne(Content::class);
    }
}
