<?php

namespace App\Auth\Oauth;

use \Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class HiworksLoginService implements OauthLoginService
{
    public $hiworkClient;
    public $hiworksBasicUrl;
    public $clientId;
    public $clientSecret;
    public function __construct(string $hiworksBasicUrl, string $clientId, string $clientSecret)
    {
        $this->hiworksBasicUrl = $hiworksBasicUrl;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->hiworkClient = new HiworksClient();
    }
    public function getAuthCode(): Response
    {
        $reponse = Http::get(
            $this->hiworksBasicUrl . "open/auth/authform?client_id=" . $this->clientId . "&access_type=offline"
        );
        return $reponse;
    }
    public function getAccessCode(string $authCode): Response
    {
        $reponse = Http::asForm()->post(
            $this->hiworksBasicUrl ."open/auth/accesstoken",
            [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'authorization_code',
                'auth_code' => $authCode,
                'access_type' => 'offline'
            ]
        );
        return $reponse;
    }
    public function setClientAccessToken(array $data): void
    {
        $this->hiworkClient->access_token = $data['access_token'];
        $this->hiworkClient->refresh_token = $data['refresh_token'];
        $this->hiworkClient->office_no = $data['office_no'];
        $this->hiworkClient->user_no = $data['user_no'];
    }
    public function getClientUserInfo() :Response
    {
        $reponse = Http::withHeaders([
            "Authorization" => "Bearer ". $this->hiworkClient->access_token,
            "Content-Type"=> "application/json"
        ])->get($this->hiworksBasicUrl ."user/v2/me");
        dd($reponse->json());
        return $reponse;
    }
    public function setClientInfo(array $data)
    {
        $this->hiworkClient->user_id = $data['user_id'];
        $this->hiworkClient->name = $data['name'];
    }
    public function getClient(): HiworksClient
    {
        return $this->hiworkClient;
    }
}
