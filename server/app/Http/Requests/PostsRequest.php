<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;
class PostsRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required','max:255'],
            'body' => ['required'],
            'category_id' =>['required'],
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'max'  => ':attribute should be shorter',
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
