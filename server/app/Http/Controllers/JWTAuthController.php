<?php

namespace App\Http\Controllers;

use App\EloquentModel\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\JWT\JWTRegisterRequest;
use App\Http\Requests\JWT\JWTRequest;
use App\Services\Interfaces\UserService;
use App\Transformers\UserTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

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
        $content = $request->only([
            'name', 'email', 'password'
        ]);
        $user = $this->user_service->registerUser($content);
        return response()->json($user);
        // return $this->transform->withUser($user);
    }
    public function login(JWTRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->transform->respondWithToken($token);
    }
    //사용안한다.
    public function user()
    {
        $token = JWTAUTH::getToken();
        $user = JWTAuth::toUser($token);
        dd($user);
        $user_info = $this->user_service->getUserInfo();
        return $this->transform->withUser($user_info);
    }


    //middleware로 갑니다.
    // public function refresh()
    // {
    //     $refresh_info = $this->user_service->refreshToken();
    //     return $this->transform->respondWithToken($refresh_info);
    // }

    // public function logout()
    // {
    //     $this->user_service->logoutUser();
    //     return $this->transform->logout();
    // }
}
