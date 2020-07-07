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


if (!function_exists('onlyContent')) {
    /**
     * @param array $base
     */
    function onlyContent(Request $request, $param=[]): array
    {
        $cachekey ='';
        $router = $request->route();
        $router_name = $router->getName();
        foreach($router->parameters() as $key=>$value) $cachekey .= ".".$value;
        if($query = $request->getQueryString()) $cachekey .= ".". urlencode($query);
        return array_merge([
            "cache_key"=>($router_name.$cachekey),
        ], $request->only($param));
    }
}

if (!function_exists('checkKeyNull')) {
    /**
     * @param array $content
     * @param string $key
     */
    function checkKeyNull($content, $key): bool
    {
        return array_key_exists($key, $content)&&$content[$key]!==null;
    }

}
