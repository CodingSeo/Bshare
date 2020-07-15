<?php

namespace App\Http\Requests;

class ImageUploadRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|mimetypes:image/jpeg,image/png|max:2000',
        ];
    }
    public function attributes()
    {
        return [
            'image' => 'image',
        ];
    }
}
