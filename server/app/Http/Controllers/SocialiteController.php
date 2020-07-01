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
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.hiworks.com/open/auth/authform?client_id=".env('HIWORKS_CLIENT_ID')."&access_type=offline",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('hiworks')->user();
        dd($user);
    }
    public function handleRedirect(){

    }
    // public function redirectToProvider()
    // {
    //     return Socialite::driver('hiworks')->stateless()->redirect()->getTargetUrl();
    // }

    // public function handleProviderCallback(Request $request)
    // {
    //     $user = Socialite::driver('hiworks')->user();
    //     dd($user);
    // }
    // public function handleRedirect(){

    // }
}
