<?php
namespace App\Transformers;

use Illuminate\Support\Collection;

class UserTransformer{

    public function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function logout(){
        return response()->json([
            'code'=>200,
            'status' => 'success',
            'message' => 'logout'
        ], 200);
    }

    public function registerResponse($user){
        return response()->json([
            'status' => 'success',
            'data' => $this->withUser($user),
        ], 200);
    }
<<<<<<< HEAD
    public function withUser(Collection $user){
=======

    public function transform($user){
        return [
            'name' => $user->get('name'),
            'email' => $user->get('email'),
            'created' => $user->get('created_at'),
        ];
    }

    public function withUser($user){
>>>>>>> faf3e5d6d00d227d4478021ca676ae44f790cd7d
        return [
            'name' => $user->get('name'),
            'email' => $user->get('email'),
            'created' => $user->get('created_at'),
        ];
    }
}
