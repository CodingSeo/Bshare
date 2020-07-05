<?php

namespace App\Http\Controllers;

use App\Auth\Oauth\OauthLoginService;
use App\EloquentModel\User;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\ApiContentRequest;
use Laravel\Socialite\Facades\Socialite;
use Config;

class SocialiteController extends Controller
{
    private $userService;
    private $oauthLoginService;
    public function __construct(UserService $userService, OauthLoginService $oauthLoginService)
    {
        $this->userService = $userService;
        $this->oauthLoginService = $oauthLoginService;
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
                $this->oauthLoginService->getClientUserInfo();
                $user = $this->oauthLoginService->getClient();
                //decide whether i'm going to cache refresh Token
            }
            return 'no AccessCode'
        }
        return 'no auth_code';
    }
}
