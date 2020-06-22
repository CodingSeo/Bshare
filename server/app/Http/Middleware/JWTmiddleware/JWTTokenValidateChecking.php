<?php

namespace App\Http\Middleware\JWTmiddleware;
use App\Auth\Manager\JWTAuthManager;
use App\Exceptions\JWTTokenException;
use Closure;

class JWTTokenValidateChecking
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
        $token = $request['token'];
        $result = $this->auth->checkTokenValidation($token);
        if(!$result) throw new JWTTokenException("Token Form Error");
        return $next($request);
    }
}
