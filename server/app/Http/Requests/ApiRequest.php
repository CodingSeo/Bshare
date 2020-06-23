<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

abstract class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'errors' => $validator->errors(),
            'links' => [
                [
                    'rel' => 'home',
                    'href' => route('api.index'),
                ],
            ]
        ], 422, [], JSON_PRETTY_PRINT));
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'string' => ':attribute should be string',
            'unique' => ':attribute is already taken',
            'numeric' => ':attribute should be numeric',
            'min' => ':attribute should be no shorter than 8 length',
            'max'  => ':attribute should be no longer than 255 length',
            'confirmed' => ':attribute does not match',
            'email' => ':attribute must be email type',
        ];
    }
}
