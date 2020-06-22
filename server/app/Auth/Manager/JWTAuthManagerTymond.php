<?php

namespace App\Auth\Manager;

use App\Auth\AuthUser;
use Exception;
use App\DTO\UserDTO;
use App\Exceptions\JWTTokenException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Claims\Collection as JWTPayloadCollection;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Claims\Factory as JWTFactory;
use Tymon\JWTAuth\Providers\JWT\Lcobucci;
use Tymon\JWTAuth\Payload;
use Tymon\JWTAuth\Token;
use Tymon\JWTAuth\Validators\TokenValidator;

class JWTAuthManagerTymond implements JWTAuthManager
{
    protected $requiredClaims = [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ];
    /**
     * @var JWTAuth
     */
    private $jwtauth;
    /**
     * @var JWTFactory
     */
    private $jwtfactory;
    /**
     * @var TokenValidator
     */
    private $tokenValidator;
    /**
     * @var Lcobucci
     */
    private $tokenProvider;
    public function __construct(JWTAuth $jwtauth, JWTFactory $jwtfactory, TokenValidator $tokenValidator, Lcobucci $tokenProvider)
    {
        $this->jwtfactory = $jwtfactory;
        $this->tokenValidator = $tokenValidator;
        $this->jwtauth = $jwtauth;
        $this->tokenProvider = $tokenProvider;
    }
    public function getToken(Request $request) : string
    {
        $token = $request->bearerToken();
        return $token;
    }
    public function getTokenPayload(string $token): array
    {
        try{
            return $this->tokenProvider->decode($token);
        }catch(Exception $e){
            throw new JWTTokenException('can not decode the token');
        }
    }
    public function checkTokenValidation(string $token): bool
    {
        try{
            return $this->tokenValidator->check($token);
        }catch(Exception $e){
            return false;
        }
    }
    /**
     * @param string $token
     * @return boolean|string
     */
    public function checkPayloadValidation(string $token)
    {
        $payload = $this->getTokenPayload($token);
        foreach($this->requiredClaims as $key){
            if (!array_key_exists($key, $payload)){
                return false;
            };
            if($payload[$key] ==null) return false;
        }
        return $payload;
    }
    public function checkTokenExpired(string $exp) : bool
    {
        $exp_now = $this->jwtfactory->exp();
        if((int)$exp>(int)$exp_now) return false;
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
        $auth_user = new AuthUser((array) $user, 'email', 'password');
        $token = $this->jwtauth::fromSubject($auth_user);
        return $token;
    }
}
