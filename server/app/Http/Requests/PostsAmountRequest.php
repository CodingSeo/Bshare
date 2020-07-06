<?php

namespace App\Http\Requests;

class PostsAmountRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount' => ['required', 'numeric'],
        ];
    }
    public function attributes()
    {
        return [
            'amount' => 'amount',
        ];
    }
}
