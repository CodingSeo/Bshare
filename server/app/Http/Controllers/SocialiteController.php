<?php

namespace App\Http\Controllers;

use App\EloquentModel\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        Socialite::driver('hiworks')->stateless()->redirect()->getTargetUrl();
        return $test;
    }

    public function handleProviderCallback(Request $request)
    {
        if($request->has('code')){

        }
        $user = Socialite::driver('hiworks')->user();
        $user = User::firstOrCreate([
            'name'  => $user->getName(),
            'email' => $user->getEmail(),
        ]);
        auth()->login($user, true);
    }
    public function handleRedirect(){

    }
}
