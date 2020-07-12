<?php

namespace App\Auth\Oauth;

use \Illuminate\Http\Client\Response;

interface OauthLoginService
{
    public function getAuthCode(): Response;
    public function getAccessCode(string $authCode): Response;
    public function setClientAccessToken(array $data): void;
    public function getClientUserInfo(): array;
    public function setClientInfo(array $data);
    public function getClient(): HiworksClient;
}
