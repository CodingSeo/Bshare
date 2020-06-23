<?php

namespace App\Http\Middleware;

use App\Auth\Manager\JWTAuthManager;
use App\Exceptions\JWTTokenNotFound;
use Closure;
use Exception;

class JWTTokenChecking
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
        $token = $this->auth->getToken($request);
        if(!$token) throw new JWTTokenNotFound();
        $request->merge([
            'token' => $token
        ]);
        return $next($request);
    }
}
