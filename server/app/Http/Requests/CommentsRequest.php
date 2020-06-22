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
            'post_id' => ['numeric', 'required'],
            'parent_id' => ['numeric'],
            'body' => ['required', 'max:255'],
        ];
    }
    public function attributes()
    {
        return [
            'post_id' => 'post_id',
            'body' => 'body',
            'parent_id' => 'parent_id'
        ];
    }
}
