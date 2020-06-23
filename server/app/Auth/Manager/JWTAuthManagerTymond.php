<?php

namespace App\Auth\Manager;

use App\Auth\AuthUser;
use Exception;
use App\DTO\UserDTO;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Validators\PayloadValidator;
use Tymon\JWTAuth\Validators\TokenValidator;

class JWTAuthManagerTymond implements JWTAuthManager
{
    /**
     * @var JWTAuth
     */
    private $jwtauth;
    private $payloadValidator;
    private $tokenValidator;
    public function __construct(JWTAuth $jwtauth, PayloadValidator $payloadValidator, TokenValidator $tokenValidator)
    {
        $this->payloadValidator = $payloadValidator;
        $this->tokenValidator = $tokenValidator;
        $this->jwtauth = $jwtauth;
    }
    public function getToken(Request $request): string
    {
        $token = $request->bearerToken();
        return $token;
    }
    public function getTokenPayload(string $token): array
    {
        $this->jwtauth::setToken($token);
        $token = $this->jwtauth::getToken();
        $payload = $this->jwtauth::getPayload($token)->toArray();
        return $payload;
    }
    public function checkTokenValidation(string $token): bool
    {
        try{
            return $this->tokenValidator->check($token);
        }catch(Exception $e){
            return false;
        }
    }
    public function checkPayloadValidation(string $token): bool
    {
        try{
            return $this->payloadValidator->check($token);
        }catch(Exception $e){
            return false;
        }
    }
    public function checkTokenExpired(Request $request): bool
    {

        return true;
    }
    public function checkTokenRefreshAble(Request $request): bool
    {

        return true;
    }
    public function checkAuthorizationToken(Request $requst): bool
    {

        return true;
    }
    public function getTokenByUserDTO(UserDTO $user): string
    {
        $auth_user = new AuthUser((array) $user, 'id', 'password');
        $token = $this->jwtauth::fromSubject($auth_user);
        return $token;
    }
}
