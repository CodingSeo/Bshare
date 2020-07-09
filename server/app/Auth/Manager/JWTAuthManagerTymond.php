<?php

namespace App\Auth\Manager;

use App\Auth\AuthUser;
use App\Cache\CacheContract;
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
    /**
     * @var CacheContract
     */
    private $cacheContract;
    public function __construct(JWTAuth $jwtauth, TokenValidator $tokenValidator,
         Lcobucci $tokenProvider, CacheContract $cacheContract)
    {
        $this->tokenValidator = $tokenValidator;
        $this->jwtauth = $jwtauth;
        $this->tokenProvider = $tokenProvider;
        $this->cacheContract = $cacheContract;
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
        return ((int) $exp < (int) $exp_now) ? false : true;
    }

    public function checkPrvCode(string $token_prv): bool
    {
        return strcmp($token_prv, sha1(AuthUser::class));
    }

    public function getAuthUserByUserDTO(UserDTO $user): AuthUser
    {
        $auth_user = new AuthUser((array) $user, 'email', 'password', null);
        $token = $this->jwtauth::fromSubject($auth_user);
        $auth_user->token = $token;
        return $auth_user;
    }

    // public function checklogout(string $token_jti) : bool
    // {
    //      this is the user issue
    //     return ($this->cache->get($token_jti))?true:false;
    // }

    // /**
    //  * @param string $token_user
    //  * @return null|Authenticatable
    //  */
    // public function checkAuthorizationToken(string $token_user)
    // {
    //     //doesn't have to check the user_id
    //     return Auth::loginUsingId($token_user);
    // }
}
