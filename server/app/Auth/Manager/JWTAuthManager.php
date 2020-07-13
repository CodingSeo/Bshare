<?php

namespace App\Auth\Manager;

use App\Auth\AuthUser;
use App\DTO\UserDTO;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

interface JWTAuthManager
{
    /**
     * @param string $token
     * @return boolean|array
     */
    public function getToken(Request $request);
    public function getTokenPayload(string $token): array;
    public function checkTokenValidation(string $token): bool;
    /**
     * @param string $token
     * @return boolean|array
     */
    public function checkTokenExpired(string $token): bool;
    public function checkPrvCode(string $token_prv): bool;
    public function getAuthUserByUserDTO(UserDTO $user): AuthUser;
    public function checkPayloadValidation(string $token);
    // public function checklogout(string $token_jti);

    // /**
    //  * @param string $token_user
    //  * @return boolean|Authenticatable
    //  */
    // public function checkAuthorizationToken(string $token_user);
}
