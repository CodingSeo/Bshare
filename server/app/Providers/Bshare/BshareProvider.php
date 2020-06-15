<?php

namespace App\Providers\Bshare;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\PostsController;
use App\Mapper\JSONMapperService;
use App\Mapper\MapperService;
use App\Repositories\Implement\CategoryRepositoryImp;
use App\Repositories\Implement\CommentRepositoryImp;
use App\Repositories\Implement\PostRepositoryImp;
use App\Repositories\Implement\UserRepositoryImp;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\CommentRepository;
use App\Repositories\Interfaces\PostRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Implement\CategoryServiceImp;
use App\Services\Implement\CommentServiceImp;
use App\Services\Implement\PostServiceImp;
use App\Services\Implement\UserServiceImp;
use App\Services\Interfaces\CategoryService;
use App\Services\Interfaces\CommentService;
use App\Services\Interfaces\PostService;
use App\Services\Interfaces\UserService;
use Illuminate\Support\ServiceProvider;

class BshareProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $container = app();
        $container->singleton(MapperService::class, JSONMapperService::class);

        $container->when(PostsController::class)->needs(PostService::class)->give(PostServiceImp::class);
        $container->when(PostServiceImp::class)->needs(PostRepository::class)->give(PostRepositoryImp::class);

        $container->when(CommentsController::class)->needs(CommentService::class)->give(CommentServiceImp::class);
        $container->when(CommentServiceImp::class)->needs(PostRepository::class)->give(PostRepositoryImp::class);
        $container->when(CommentServiceImp::class)->needs(CommentRepository::class)->give(CommentRepositoryImp::class);


        $container->when(CategoriesController::class)->needs(CategoryService::class)->give(CategoryServiceImp::class);
        $container->when(CategoryServiceImp::class)->needs(CategoryRepository::class)->give(CategoryRepositoryImp::class);

        $container->when(UserServiceImp::class)->needs(UserRepository::class)->give(UserRepositoryImp::class);
        $container->when(JWTAuthController::class)->needs(UserService::class)->give(UserServiceImp::class);

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
