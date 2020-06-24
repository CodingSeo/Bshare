<?php

namespace App\Http\Middleware\JWTmiddleware;

use App\Auth\JWTAttemptUser;
use App\Auth\Manager\JWTAuthManager;
use App\Exceptions\JWTTokenException;
use Illuminate\Contracts\Auth\UserProvider;
use Closure;
use Illuminate\Auth\DatabaseUserProvider;
use Illuminate\Auth\SessionGuard;

class JWTAuthorizationChecking
{
    /**
     * @var JWTAuthManager
     */
    private $authManager;
    /**
     * @var JWTAttemptUser
     */
    private $attemptUser;
    public function __construct(JWTAuthManager $authManager, JWTAttemptUser $attemptUser)
    {
        $this->authManager = $authManager;
        $this->attemptUser = $attemptUser;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token_jti = $this->attemptUser->getPayload()['jti'];
        $token_user = $this->attemptUser->getPayload()['sub'];
        $token_prv = $this->attemptUser->getPayload()['prv'];

        //prv chekcing sha1() object
        if($this->authManager->checkPrvCode($token_prv))
            throw new JWTTokenException('Illegal Approach (prv)');

        //logout -> cached?????? this is ridiculous...let's check out it can be done
        //is there other way to do this? using jti maybe there is another option?

        //get the user id throw Auth
        $user_auth = $this->authManager->checkAuthorizationToken($token_user);
        if(!$user_auth) throw new JWTTokenException('Illegal User');

        //well.. this should be done this way but it's still working...?
        $this->attemptUser->setAuthUser($user_auth);
        return $next($request);
    }
}
