<?php

namespace App\Providers\Bshare;

use App\DTO\DTO;
use App\DTO\EloquentDTO;
use App\Repositories\Implement\CategoryRepositoryImp;
use App\Repositories\Implement\CommentRepositoryImp;
use App\Repositories\Implement\PostRepositoryImp;
use App\Repositories\Implement\UserRepositoryImp;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\CommentRepository;
use App\Repositories\interfaces\PostRepository;
use App\Repositories\interfaces\UserRepository;
use App\Services\Implement\CategoryServiceImp;
use App\Services\Implement\CommentServiceImp;
use App\Services\Implement\PostServiceImp;
use App\Services\Implement\UserServiceImp;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $container = app();

        //binding careful
        // $container->bind(DTO::class,EloquentDTO::class);
        #tag 사용 검토
        // $container->when(PostsController::class)->needs(DTO::class)->give(EloquentDTO::class);


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
