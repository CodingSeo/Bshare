<?php

namespace App\Http\Middleware\JWTmiddleware;
use App\Auth\Manager\JWTAuthManager;
use App\Exceptions\JWTTokenException;
use Closure;

class JWTPayloadValidateChecking
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
        $payload = $this->auth->checkPayloadValidation($token);
        if(!$payload) throw new JWTTokenException('Token Payload Format is Wrong');
        $request->merge([
            'payload' => $payload
        ]);
        return $next($request);
    }
}
