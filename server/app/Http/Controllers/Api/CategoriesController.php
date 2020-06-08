<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\PostTransformer;
use App\Category;

class CategoriesController extends Controller
{
    
    public function index(Category $category)
    {
        return (new PostTransformer)->withPagination($category->posts()->latest()->paginate(5));
    }
    // public function index($category_id)
    // {
    //     return (new PostTransformer)->withPagination Category::find($category_id)->posts()->latest()->paginate(5));
    // }
}
