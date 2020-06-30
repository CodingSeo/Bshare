<?php

namespace App\Transformers;

use App\Auth\AuthUser;
use App\DTO\UserDTO;
use Illuminate\Support\Collection;

class UserTransformer
{

    public function respondWithToken(AuthUser $authUser)
    {
        return response()->json([
            'user_info' => [
                'name' => $authUser->name,
                'email' => $authUser->email,
            ],
            'access_token' => $authUser->token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'logout'
        ], 200);
    }

    public function registerResponse(UserDTO $user)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->transformUser($user),
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function transformUser($user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}
