<?php
return ([
    'check_cache' => env('CACHE_CHECK',null),
    'server' => env('MEMCACHED_HOST'),
    'port' => env('MEMCACHED_PORT')
]);
