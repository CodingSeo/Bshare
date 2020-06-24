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
        $token_user = $this->attemptUser->getPayload()['sub'];

        //get the user id throw Auth
        $user_auth = $this->authManager->checkAuthorizationToken($token_user);
        if(!$user_auth) throw new JWTTokenException('Illegal User');

        //well.. this should be done this way but it's still working...?
        $this->attemptUser->setAuthUser($user_auth);
        return $next($request);
    }
}
