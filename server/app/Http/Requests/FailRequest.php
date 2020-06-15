<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'code' => 422,
        'errors' => $validator->errors(),
        'links' =>[
            [
                'rel' => 'self',
                'href' => $this->getRedirectUrl(),
            ],
        ]
        ], 422,[],JSON_PRETTY_PRINT));
    }
}
