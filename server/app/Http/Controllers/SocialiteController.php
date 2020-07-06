<?php

namespace App\Http\Controllers;

use App\Auth\Oauth\OauthLoginService;
use App\EloquentModel\User;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\ApiContentRequest;
use Laravel\Socialite\Facades\Socialite;
use App\Transformers\UserTransformer;
use Config;

class SocialiteController extends Controller
{
    private $userService;
    private $oauthLoginService;
    private $transform;
    public function __construct(UserService $userService, OauthLoginService $oauthLoginService, UserTransformer $transform)
    {
        $this->userService = $userService;
        $this->oauthLoginService = $oauthLoginService;
        $this->transform = $transform;
    }

    public function redirectToProvider()
    {
        return $this->oauthLoginService->getAuthCode();
    }

    public function handleProviderCallback(ApiContentRequest $request)
    {
        if ($request->auth_code) {
            $response = $this->oauthLoginService->getAccessCode($request->auth_code);
            if($response->successful()){
                $this->oauthLoginService->setClientAccessToken($response->json()['data']);
                $user_info = $this->oauthLoginService->getClientUserInfo();
                $authUser = $this->userService->loginOauthUser($user_info);
                return $this->transform->respondWithToken($authUser);
            }
            return 'No AccessCode';
        }
        return 'No Auth_code';
    }
}
