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
    public function __construct(UserService $user_service, UserTransformer $transform)
    {
        $this->user_service = $user_service;
        $this->transform = $transform;
    }

    public function register(JWTRegisterRequest $request)
    {
<<<<<<< HEAD
        $user = $this->user_service->registerUser($request->all());
        return $this->transform->withUser($user);
=======
        $content = $request->only([
            'name', 'email', 'password'
        ]);
        $user = $this->user_service->registerUser($content);
        return response()->json($user);
        // return $this->transform->withUser($user);
>>>>>>> faf3e5d6d00d227d4478021ca676ae44f790cd7d
    }

    public function login(JWTRequest $request)
    {
        $content = $request->only([
            'email', 'password'
        ]);
        $token = $this->user_service->loginUser($content);
        return $this->transform->respondWithToken($token);
    }

    public function user()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    //middleware로 갑니다.
    public function refresh()
    {
        $refresh_info = auth('api')->refresh();
        return $this->transform->respondWithToken($refresh_info);
    }

    public function logout()
    {
        auth()->logout();
        return $this->transform->logout();
    }

}
