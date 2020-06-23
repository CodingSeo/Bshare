<?php

namespace App\Auth\Manager;

use App\Auth\AuthUser;
use Exception;
use App\DTO\UserDTO;
use App\Exceptions\JWTTokenException;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Providers\JWT\Lcobucci;
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
     * @var TokenValidator
     */
    private $tokenValidator;
    /**
     * @var Lcobucci
     */
    private $tokenProvider;
    public function __construct(JWTAuth $jwtauth, TokenValidator $tokenValidator, Lcobucci $tokenProvider)
    {
        $this->tokenValidator = $tokenValidator;
        $this->jwtauth = $jwtauth;
        $this->tokenProvider = $tokenProvider;
    }
    /**
     * @param Request
     * @return boolean|string
     */
    public function getToken(Request $request)
    {
        $token = $request->bearerToken();
        return $token;
    }
    public function checkTokenValidation(string $token): bool
    {
        try {
            return $this->tokenValidator->check($token);
        } catch (Exception $e) {
            return false;
        }
    }
    /**
     * @param string $token
     * @return boolean|array
     */
    public function checkPayloadValidation(string $token)
    {
        $payload = $this->getTokenPayload($token);
        foreach ($this->requiredClaims as $key) {
            if (
                !array_key_exists($key, $payload) ||
                $payload[$key] == null
            ) {
                return false;
            };
        }
        return $payload;
    }
    public function getTokenPayload(string $token): array
    {
        try {
            return $this->tokenProvider->decode($token);
        } catch (Exception $e) {
            throw new JWTTokenException('can not decode the token');
        }
    }
    public function checkTokenExpired(string $exp): bool
    {
        $exp_now = Carbon::now('UTC')->getTimestamp();
        if ((int) $exp < (int) $exp_now) return false;
        return true;
    }
    /**
     * @param string $token_user
     * @return null|Authenticatable
     */
    public function checkAuthorizationToken(string $token_user)
    {
        //cache? or db access?
        return Auth::loginUsingId($token_user);
    }
    public function checkPrvCode(string $token_prv): bool
    {
        return strcmp($token_prv, sha1(AuthUser::class));
    }
    public function getTokenByUserDTO(UserDTO $user): string
    {
        $auth_user = new AuthUser((array) $user, 'email', 'password', null);
        $token = $this->jwtauth::fromSubject($auth_user);
        return $token;
    }
}
