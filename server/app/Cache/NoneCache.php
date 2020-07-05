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
    public function destroy($key)
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
    public function remember($key, Closure $callback, $ttl = null)
    {
        $this->put($key, $value = $callback(), $ttl);
        return $value;
    }
}
