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
                    'href' => route('api.index'),
                ],
                // [
                //     'category'=>'category 1',
                //     'href' => route('api.category.index', 1),
                // ],
                // [
                //     'category'=>'category 2',
                //     'href' => route('api.category.index', 2),
                // ],
                // [
                //     'category'=>'category 3',
                //     'href' => route('api.category.index', 3),
                // ],
                // [
                //     'category'=>'category 4',
                //     'href' => route('api.category.index', 4),
                // ],
            ]
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
