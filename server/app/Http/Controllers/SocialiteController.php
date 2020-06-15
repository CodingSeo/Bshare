<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('hiworks')->stateless()->redirect()->getTargetUrl();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('hiworks')->user();
        // $user = User::firstOrCreate([
        //     'name'  => $user->getName(),
        //     'email' => $user->getEmail(),
        // ]);
        // auth()->login($user, true);
    }

}
