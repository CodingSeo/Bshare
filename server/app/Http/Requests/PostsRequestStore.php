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
            'category_id' => ['required', 'numeric', 'min:0', 'max:4'],
            'images_info' => ['array', 'max:5', 'nullable'],
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'title',
            'body'  => 'body',
            'category_id' => 'category ID',
            'images_info' => 'images_info'
        ];
    }
}
