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
            'name' => ['required','string','max:100'],
            'email' => ['required','email','max:255'],
            'password' => ['required','string','min:8','max:255','confirmed'],
            'password_confirmation' => ['required','string','min:8','max:255'],
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'string' => ':attribute should be string',
            'min' => ':attribute should be no shorter than 8 length',
            'max'  => ':attribute should be no longer than 255 length',
            'confirmed' =>':attribute does not match',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'name',
            'email'  => 'email',
            'password'=>'password',
            'password_confirmation' => 'password_confirmation'
        ];
    }
}
