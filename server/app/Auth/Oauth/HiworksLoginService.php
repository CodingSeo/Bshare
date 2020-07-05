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
            $this->hiworksBasicUrl . "authform?client_id=" . $this->clientId . "&access_type=offline"
        );
        return $reponse;
    }
    public function getAccessCode(string $authCode): Response
    {
        $reponse = Http::post(
            $this->hiworksBasicUrl . "/auth/accesstoken",
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
    public function setClientAccessToken()
    {
    }
    public function setClientInfo()
    {
    }
    public function getClient(): HiworksClient
    {
        return $this->hiworkClient;
    }
}
