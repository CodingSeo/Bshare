<?php

namespace App\Http\Middleware\JWTmiddleware;

use App\Auth\JWTAttemptUser;
use App\Auth\Manager\JWTAuthManager;
use App\Exceptions\JWTTokenException;
use Closure;

class JWTPayloadValidateChecking
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
        $token = $this->attemptUser->getToken();
        $payload = $this->authManager->checkPayloadValidation($token);
        if (!$payload) throw new JWTTokenException('Token Payload Format is Wrong');
        $token_prv = $payload['prv'];
        //prv chekcing sha1() object
        if ($this->authManager->checkPrvCode($token_prv))
            throw new JWTTokenException('Illegal Approach (prv)');

        // $token_jti = $payload['jti'];
        //logout -> cached?????? this is ridiculous...let's check out it can be done
        //is there other way to do this? using jti maybe there is another option?


        $this->attemptUser->setPayload($payload);
        return $next($request);
    }
}
