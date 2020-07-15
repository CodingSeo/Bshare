<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class PostsRequestTradeUpdate extends ApiRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'post_id' => ['required', 'numeric'],
            'trade_status'=>['required']
        ];
    }
    public function attributes()
    {
        return [
            'post_id'=>'post_id',
            'trade_status'=>'trade_status'
        ];
    }
}
