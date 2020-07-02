<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JWT\JWTRegisterRequest;
use App\Http\Requests\JWT\JWTRequest;
use App\Services\Interfaces\UserService;
use App\Transformers\UserTransformer;
use App\Auth\JWTAttemptUser as AuthUser;

class JWTAuthController extends Controller
{
    protected $user_service, $transform, $authUser;
    public function __construct(AuthUser $authUser, UserService $user_service, UserTransformer $transform)
    {
        $this->authUser = $authUser;
        $this->user_service = $user_service;
        $this->transform = $transform;
    }

    public function register(JWTRegisterRequest $request)
    {
        $content = $request->only([
            'name', 'email', 'password'
        ]);
        $user = $this->user_service->registerUser($content);
        return $this->transform->registerResponse($user);
    }

    public function login(JWTRequest $request)
    {
        $content = $request->only([
            'email', 'password'
        ]);
        $authUser = $this->user_service->loginUser($content);
        return $this->transform->respondWithToken($authUser);
    }

    // //middleware로 갑니다.
    // public function refresh()
    // {
    //     $refresh_info = auth('api')->refresh();
    //     return $this->transform->respondWithToken($refresh_info);
    // }
}
