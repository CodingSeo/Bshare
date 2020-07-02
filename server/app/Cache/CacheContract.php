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
     * @return void
     */
    public function add($key, $value, $ttl);
    /**
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return void
     */
    public function forever($key, $value);

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
     * @return void
     */
    public function flush();
    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key, $ttl, Closure $callback);
}
