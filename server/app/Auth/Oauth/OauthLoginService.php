<?php

namespace App\Auth\Oauth;

use \Illuminate\Http\Client\Response;

interface OauthLoginService
{
    public function getAuthCode(): Response;
    public function getAccessCode(string $authCode): Response;
    public function setClientAccessToken();
    public function setClientInfo();
    public function getClient(): HiworksClient;
}
