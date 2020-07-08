<?php

use Illuminate\Http\Request;
use Illuminate\Support\Arr;


if (!function_exists('onlyContent')) {
    /**
     * @param array $base
     */
    function onlyContent(Request $request, $param = []): array
    {
        $results = [];
        $input = $request->all();
        $placeholder = new stdClass;
        foreach ($param as $key) {
            $value = data_get($input, $key, $placeholder);
            if ($value !== $placeholder) {
                Arr::set($results, $key, $value);
            } else {
                Arr::set($results, $key, null);
            }
        }
        return $results;
    }
}

if (!function_exists('checkKeyNull')) {
    /**
     * @param array $content
     * @param string $key
     */
    function checkKeyNull($content, $key): bool
    {
        return array_key_exists($key, $content) && $content[$key] !== null;
    }
}
