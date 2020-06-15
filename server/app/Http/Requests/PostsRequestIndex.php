<?php

namespace App\Http\Requests;

class PostsRequestIndex extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'post_id' => ['required', 'numeric'],
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
