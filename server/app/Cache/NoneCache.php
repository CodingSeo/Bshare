<?php

namespace App\Cache;

use Closure;

class NoneCache implements CacheContract
{

    public function __construct()
    {
    }
    /**
     * @param  string  $key
     * @param  mixed  $value
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     *
     * @return bool
     */
    public function put($key, $value, $ttl = null)
    {
        return false;
    }

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return false;
    }

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function pull($key)
    {
        return false;
    }

    /**
     * @return bool
     */
    public function flush()
    {
        return false;
    }
    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key,  $ttl = null, Closure $callback)
    {
        return $callback();
    }
    /**
     * @param  string  $key
     * @return mixed
     */
    public function getMulti($keys)
    {
        return null;
    }
    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @return mixed
     */
    public function setMulti($keys, $ttl)
    {
        return null;
    }
    public function deleteMulti(array $keys): array
    {
        return [];
    }
}
