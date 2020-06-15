<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class CommentsRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body'=>['required','max:255'],
        ];
    }
    public function message(){
        return[
            'required'=>':arribute should be required.',
        ];
    }
    public function attributes(){
        return[
            'body'=>'body'
        ];
    }
}
