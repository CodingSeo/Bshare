<?php
return ([
    'check_cache' => env('CACHE_CHECK',null),
    'server' => env('MECACHED_HOST'),
    'port' => env('MECACHED_PORT')
]);
