<?php

namespace App\Providers\Bshare;

use App\Auth\Manager\JWTAuthManager;
use App\Auth\Manager\JWTAuthManagerTymond;
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
use App\Auth\AuthUser;
use App\Auth\JWTAttemptUser;
use App\Auth\Oauth\HiworksLoginService;
use App\Auth\Oauth\OauthLoginService;
use App\Cache\CacheContract;
use App\Cache\MemcachedCache;
use App\Cache\NoneCache;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\SocialiteController;
use App\Repositories\Implement\ContentRepositoryImp;
use App\Repositories\Implement\ImageRepositoryImp;
use App\Repositories\Implement\StorageRepositoryImp;
use App\Repositories\Interfaces\ContentRepository;
use App\Repositories\Interfaces\ImageRepository;
use App\Repositories\Interfaces\StorageRepository;
use App\Services\Implement\ImageServiceImp;
use App\Services\Interfaces\ImageService;

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
        if ((config('memcached.check_cache') === 'memcached')) {
            $cacheService = new MemcachedCache(
                config('memcached.server'),
                config('memcached.port')
            );
        } else {
            $cacheService = new NoneCache(); //file cache로 변경
        }

        $container->singleton(CacheContract::class, function () use ($cacheService) {
            return $cacheService;
        });

        //mapper
        $container->singleton(MapperService::class, JSONMapperService::class);

        //auth
        $container->singleton(JWTAuthManager::class, JWTAuthManagerTymond::class);
        $container->singleton(JWTAttemptUser::class, function () {
            return new JWTAttemptUser(new AuthUser([], 'email', 'password', null));
        });
        //hiworks
        $container->singleton(OauthLoginService::class, function () {
            return new HiworksLoginService(
                'https://api.hiworks.com/',
                config('social.hiwork_client'),
                config('social.hiwork_client_secret')
            );
        });

        $container->when(PostsController::class)->needs(PostService::class)->give(PostServiceImp::class);
        $container->when(PostServiceImp::class)->needs(PostRepository::class)->give(PostRepositoryImp::class);
        $container->when(PostServiceImp::class)->needs(CategoryRepository::class)->give(CategoryRepositoryImp::class);
        $container->when(PostServiceImp::class)->needs(CommentRepository::class)->give(CommentRepositoryImp::class);
        $container->when(PostServiceImp::class)->needs(ContentRepository::class)->give(ContentRepositoryImp::class);

        $container->when(CommentsController::class)->needs(CommentService::class)->give(CommentServiceImp::class);
        $container->when(CommentServiceImp::class)->needs(PostRepository::class)->give(PostRepositoryImp::class);
        $container->when(CommentServiceImp::class)->needs(CommentRepository::class)->give(CommentRepositoryImp::class);

        $container->when(CategoriesController::class)->needs(CategoryService::class)->give(CategoryServiceImp::class);
        $container->when(CategoryServiceImp::class)->needs(CategoryRepository::class)->give(CategoryRepositoryImp::class);

        $container->when(UserServiceImp::class)->needs(UserRepository::class)->give(UserRepositoryImp::class);
        $container->when(JWTAuthController::class)->needs(UserService::class)->give(UserServiceImp::class);
        $container->when(SocialiteController::class)->needs(UserService::class)->give(UserServiceImp::class);

        $container->when(ImagesController::class)->needs(ImageService::class)->give(ImageServiceImp::class);
        $container->when(ImageServiceImp::class)->needs(ImageRepository::class)->give(ImageRepositoryImp::class);
        $container->when(ImageServiceImp::class)->needs(StorageRepository::class)->give(StorageRepositoryImp::class);

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
