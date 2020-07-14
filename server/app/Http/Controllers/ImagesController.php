<?php

namespace App\Http\Controllers;

use App\Auth\JWTAttemptUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use App\Services\Interfaces\ImageService;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    protected  $authUser, $imagesService;
    public function __construct(JWTAttemptUser $authUser, ImageService $imageService)
    {
        $this->authUser = $authUser;
        $this->imagesService = $imageService;
    }
    public function uploadImages(ImageUploadRequest $request)
    {
        $requestContent = onlyContent($request, [
            'image'
        ]);
        $fileDTO = $this->imagesService->uploadImages($requestContent);
        return response()->json($fileDTO,200,[],JSON_PRETTY_PRINT);
    }

    public function deleteImages(Request $request)
    {

        $user = $this->authUser->getAuthUser();
    }
}
