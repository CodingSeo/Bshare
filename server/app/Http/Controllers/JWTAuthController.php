<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JWT\JWTRegisterRequest;
use App\Http\Requests\JWT\JWTRequest;
use App\Services\Interfaces\UserService;
use App\Transformers\UserTransformer;

class JWTAuthController extends Controller
{
    protected $user_service, $transform;
    public function __construct(UserService $user_service,UserTransformer $transform)
    {
        $this->user_service = $user_service;
        $this->transform = $transform;
    }
    public function register(JWTRegisterRequest $request)
    {
        $user = $this->user_service->registerUser($request->all());
        return $this->transform->withUser($user);
    }
    public function login(JWTRequest $request)
    {
        //middleware
        $token = $this->user_service->loginUser($request->all());
        return $this->transform->respondWithToken($token);
    }

    public function user()
    {
        $user_info = $this->user_service->getUserInfo();
        return $this->transform->withUser($user_info);
    }

    public function refresh()
    {
        $refresh_info = $this->user_service->refreshToken();
        return $this->transform->respondWithToken($refresh_info);
    }

    public function logout()
    {
        $this->user_service->logoutUser();
        return $this->transform->logout();
    }
}
