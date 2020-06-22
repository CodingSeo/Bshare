<?php
namespace App\Auth\Manager;

use App\DTO\UserDTO;
use Illuminate\Http\Request;

interface JWTAuthManager{
    public function getToken(Request $request) : string;
    public function getTokenPayload(string $token) : array;
    public function checkTokenValidation(string $token) : bool;
    /**
     * @param string $token
     * @return boolean|string
     */
    public function checkPayloadValidation(string $token);
    public function checkTokenExpired(string $token) : bool;
    public function checkTokenRefreshAble(Request $request) : bool;
    public function checkAuthorizationToken(Request $requst) : bool;
    public function getTokenByUserDTO(UserDTO $user): string;
}
