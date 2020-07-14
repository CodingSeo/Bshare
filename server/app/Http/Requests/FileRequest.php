<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "files"    => "required|array|min:1|max:5",
            'files.*' => 'required|mimetypes:image/jpeg,image/png,image/bmp|max:2000',
        ];
    }
    public function attributes()
    {
        return [
            'images' => 'images',
        ];
    }
}
