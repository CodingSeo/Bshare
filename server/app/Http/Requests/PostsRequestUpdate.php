<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class PostsRequestUpdate extends ApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'post_id' => ['required', 'numeric'],
            'title' => ['required', 'max:255'],
            'body' => ['required'],
        ];
    }
    public function attributes()
    {
        return [
            'post_id'=>'post_id',
            'title' => 'title',
            'body'  => 'body',
        ];
    }
}
