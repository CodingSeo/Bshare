<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class CateogriesIndexRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => ['numeric', 'required'],
        ];
    }
    public function attributes()
    {
        return [
            'category_id' => 'category_id',
        ];
    }
}
