<?php

namespace App\Http\Controllers;

use App\EloquentModel\User;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\ApiContentRequest;
use Laravel\Socialite\Facades\Socialite;
use Config;
use GuzzleHttp\Client;

class SocialiteController extends Controller
{
    private $userService;
    public function __construct(UserService $userService, )
    {
        $this->userService = $userService;
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
        curl_close($curl);
        echo($response);
        $client = new Client();
        $client->request('get','');

    }

    public function handleProviderCallback(ApiContentRequest $request)
    {
        if($request->auth_code){
            $hiworks_auth_code = $request->auth_code;
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
                'grant_type' => 'authorization_code','auth_code' => $hiworks_auth_code,'access_type' => 'offline'),
                CURLOPT_HTTPHEADER => array(),
            ));
            // "code": "SUC",
            // "msg": "",
            // "data": {
            //     "access_token": "il8nqtfus0y7ndlyym2zxyl4yw80jdt1",
            //     "refresh_token": "rbwr5pb83zlvyve6s9zhbtttejr4ysj1",
            //     "office_no": "123123",
            //     "user_no": "1234567"
            // }
            $response = json_decode(curl_exec($curl)); //저장?
            if($response->code==='SUC'){
                $user = $response->data;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.hiworks.com/user/v2/me",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $user->access_token",
                        "Content-Type: application/json"
                    ),
                    ));
                $response = json_decode(curl_exec($curl));
                // "user_id": "sjg"
                // "name": "Diego(서진교)"
                dd($response);
            }
            //call back function need to be implemented
            else{
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
                'grant_type' => 'refresh_token','refresh_token' => $response->data->refresh_token,'access_type' => 'offline'),
                ));
            }
        }
        curl_close($curl);
    }
}
