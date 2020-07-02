<?php

namespace App\Http\Controllers;

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
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function authorizedUser(){
        
    }
    public function redirectToProvider()
    {
        $hiworks_client_id = config('social.hiwork_client');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.hiworks.com/open/auth/authform?client_id=".$hiworks_client_id."&access_type=offline",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        echo($response);
        // $test = 'pvymej6rjzrdsqdptzb97zxljbdxusrn';
        // $hiworks_client_id = config('social.hiwork_client');
        // $hiworks_client_secret = config('social.hiwork_client_secret');
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.hiworks.com/open/auth/accesstoken",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => array('client_id' => $hiworks_client_id,'client_secret' => $hiworks_client_secret,
        //     'grant_type' => 'authorization_code','auth_code' => $test,'access_type' => 'offline'),
        //     CURLOPT_HTTPHEADER => array(),
        // ));
        // $response = curl_exec($curl);
        // curl_close($curl);
        // echo $response;
    }

    public function handleProviderCallback(ApiContentRequest $request)
    {
        #save auth code from $request
        dd($hiwokrs_auth_code = $request->auth_code);
        $test = 'pvymej6rjzrdsqdptzb97zxljbdxusrn';
        $hiworks_client_id = config('social.hiwork_client');
        $hiworks_client_secret = config('social.hiwork_client_secret');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.hiworks.com/open/auth/accesstoken",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('client_id' => $hiworks_client_id,'client_secret' => $hiworks_client_secret,
            'grant_type' => 'authorization_code','auth_code' => '{{auth_code}}','access_type' => 'offline'),
            CURLOPT_HTTPHEADER => array(),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    public function handleRedirect(Reqeust $request)
    {
        
    }
}
