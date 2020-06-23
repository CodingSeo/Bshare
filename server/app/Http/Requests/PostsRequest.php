<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class PostsRequestStore extends ApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'category_id' => ['required'],
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'title',
            'body'  => 'body',
        ];
    }
}
