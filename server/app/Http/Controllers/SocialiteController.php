<?php

namespace App\Http\Controllers;

use App\EloquentModel\User;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function redirectToProvider()
    {
        return Socialite::driver('hiworks')->stateless()->redirect()->getTargetUrl();
    }

    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('hiworks')->user();
        dd($user);
    }
    public function handleRedirect(){

    }
}
