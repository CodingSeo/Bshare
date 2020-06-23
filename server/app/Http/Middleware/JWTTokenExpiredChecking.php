<?php

namespace App\Http\Middleware;

use App\Auth\Manager\JWTAuthManager;
use App\Exceptions\JWTTokenException;
use Closure;

class JWTTokenExpiredChecking
{
    /**
     * @var JWTAuthManager
     */
    private $auth;
    public function __construct(JWTAuthManager $auth)
    {
        $this->auth = $auth;
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
        if(!$this->auth->checkTokenValidation($request)) throw new JWTTokenException('Token Expired');
        return $next($request);
    }
}
