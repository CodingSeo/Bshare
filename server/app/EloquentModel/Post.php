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
        return $this->hasMany(Comment::class)->active()->with('replies');
    }
    public function content()
    {
        return $this->hasOne(Content::class);
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
