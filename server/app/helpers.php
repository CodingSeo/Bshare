<?php

use Illuminate\Http\Request;

if (!function_exists('taggable')) {
    /**
     * @return bool
     */
    function taggable()
    {
        return in_array(config('cache.default'), ['memcached', 'redis'], true);
    }
}

if (! function_exists('cache_key')) {
    /**
     * @param $base
     * @return string
     */
    function cache_key($base)
    {
        $key = ($query = request()->getQueryString())
            ? $base . '.' . urlencode($query)
            : $base;

        return md5($key);
    }
}

if (!function_exists('onlyContent')) {
    /**
     * @param array $base
     */
    function onlyContent(Request $request, $param=[]): array
    {
        $key ='';
        if($query = request()->getQueryString()) $key = '.' . urlencode($query);
        return array_merge([
            "cache_tag"=>($request->route()->getName()),
            "cache_key"=>($request->route()->getName().$key),
        ], $request->only($param));
    }
}
