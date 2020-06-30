<?php

namespace App\Http\Requests\JWT;

use App\Http\Requests\ApiRequest;

class JWTRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ];
    }
    public function attributes()
    {
        return [
            'email'  => 'email',
            'password' => 'password',
        ];
    }
}
