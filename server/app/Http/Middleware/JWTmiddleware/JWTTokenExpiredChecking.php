<?php

namespace App\Http\Middleware\JWTmiddleware;

use App\Auth\JWTAttemptUser;
use App\Auth\Manager\JWTAuthManager;
use App\Exceptions\JWTTokenException;
use Closure;

class JWTTokenExpiredChecking
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
        $exp = $this->attemptUser->getPayload()['exp'];
        if (!$this->authManager->checkTokenExpired($exp))
            throw new JWTTokenException('Token Expired');
        return $next($request);
    }
}
