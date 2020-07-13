<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\JWT\JWTRegisterRequest;
use App\Http\Requests\JWT\JWTRequest;
use App\Services\Interfaces\UserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;

class JWTAuthController extends Controller
{
    protected $user_service, $transform, $authUser;
    public function __construct(UserService $user_service, UserTransformer $transform, JWTAttemptUser $authUser)
    {
        $this->authUser = $authUser;
        $this->user_service = $user_service;
        $this->transform = $transform;
    }

    public function register(JWTRegisterRequest $request):JsonResponse
    {
        $content = onlyContent($request, [
            'name', 'email', 'password'
        ]);
        $user = $this->user_service->registerUser($content);
        return $this->transform->UserResponse($user);
    }

    public function login(JWTRequest $request):JsonResponse
    {
        $content = onlyContent($request, [
            'email', 'password'
        ]);
        $certifiedUser = $this->user_service->loginUser($content);
        return $this->transform->respondWithToken($certifiedUser);
    }

    public function userInformation() :JsonResponse
    {
        $user = $this->authUser->getAuthUser();
        $authUserInformation = $this->user_service->getUserInformation($user);
        return $this->transform->UserInfoResponse($authUserInformation);
    }
}
