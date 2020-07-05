<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class CommentsUpdateRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comment_id'=>['numeric','required'],
            'parent_id' => ['nullable','numeric'],
            'body' => ['required', 'string', 'max:255'],
        ];
    }
    public function attributes()
    {
        return [
            'comment_id'=>'comment_id',
            'body' => 'body',
            'parent_id' => 'parent_id'
        ];
    }
}
