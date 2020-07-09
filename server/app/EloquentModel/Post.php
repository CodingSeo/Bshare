<?php

namespace App\EloquentModel;

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
        return $this->hasMany(Comment::class)->active()->parent()->with('replies');
    }
    public function content()
    {
        return $this->hasOne(Content::class);
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function scopeParent($query)
    {
        return $query->where('parent_id',null);
    }
}
