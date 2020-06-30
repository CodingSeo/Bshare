<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class CommentDestoryRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comment_id' => ['numeric', 'required'],
            'post_id' =>['numeric','required']
        ];
    }
    public function attributes()
    {
        return [
            'comment_id' => 'comment_id',
            'post_id' => 'post_id'
        ];
    }
}
