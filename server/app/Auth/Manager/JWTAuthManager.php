<?php
namespace App\Auth\Manager;

use App\DTO\UserDTO;
use Illuminate\Http\Request;

interface JWTAuthManager{
    public function getToken(Request $request) : string;
    public function getTokenPayload(string $token) : array;
    public function checkTokenValidation(string $token) : bool;
    public function checkPayloadValidation(string $token): bool;
    public function checkTokenExpired(Request $request) : bool;
    public function checkTokenRefreshAble(Request $request) : bool;
    public function checkAuthorizationToken(Request $requst) : bool;
    public function getTokenByUserDTO(UserDTO $user): string;
}
