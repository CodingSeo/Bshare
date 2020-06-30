<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*','auth/*','dev/*'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

<<<<<<< HEAD
    'allowed_origins' => ['http://localhost:80','http://localhost:8080'],
=======
    'allowed_origins' => ['*'],
>>>>>>> 163c4d0158d07c8277583907a58d32e155bfc2de

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type, Authorization'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
