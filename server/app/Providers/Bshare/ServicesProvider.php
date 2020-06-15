<?php

namespace App\Providers\Bshare;

use App\DTO\DTO;
use App\DTO\EloquentDTO;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\PostsController;
use App\Services\Implement\CategoryServiceImp;
use App\Services\Implement\CommentServiceImp;
use App\Services\Implement\PostServiceImp;
use App\Services\Implement\UserServiceImp;
use App\Services\Interfaces\CategoryService;
use App\Services\Interfaces\CommentService;
use App\Services\Interfaces\PostService;
use App\Services\Interfaces\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
