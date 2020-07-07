<?php

namespace App\Cache;

use Closure;

interface CacheContract
{
    /**
     * @param  string  $key
     * @param  mixed  $value
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     *
     * @return bool
     */
    public function put($key, $value, $ttl=null);

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function destroy($key);
    /**
     * @return bool
     */
    public function flush();
    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key, Closure $callback, $ttl=null);
    /**
     * @param  string  $key
     * @return mixed
     */
    public function getMulti($keys);
    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @return mixed
     */
    public function setMulti($keys,$ttl);
}
