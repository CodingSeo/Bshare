<?php
namespace App\Auth\Manager;

use App\DTO\UserDTO;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

interface JWTAuthManager{
    public function getToken(Request $request) : string;
    public function getTokenPayload(string $token) : array;
    public function checkTokenValidation(string $token) : bool;
    /**
     * @param string $token
     * @return boolean|array
     */
    public function checkPayloadValidation(string $token);
    public function checkTokenExpired(string $token) : bool;
    /**
     * @param string $token_user
     * @return boolean|Authenticatable
     */
    public function checkAuthorizationToken(string $token_user);
    public function checkPrvCode(string $token_prv): bool;

    public function getTokenByUserDTO(UserDTO $user): string;
}
