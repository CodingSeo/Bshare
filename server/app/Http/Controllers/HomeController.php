<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // private $transform;
    // public function __construct(Transformer $transForm)
    // {
    //     $this->transform = $transForm;
    // }
    public function index()
    {
        return response()->json([
            'name' => config('project.name') . ' API',
            'massage' => 'This is a base endpoint of Bshare API.',
            'links' => [
                [
                    'rel' => 'self',
                    // 'href' => route('api.index'),
                ],
            ]
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
