<?php

namespace App\Http\Requests\JWT;

use App\Http\Requests\ApiRequest;

class JWTRegisterRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:10'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:10', 'max:20', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:10', 'max:20'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'name',
            'email'  => 'email',
            'password' => 'password',
            'password_confirmation' => 'password_confirmation'
        ];
    }
}
