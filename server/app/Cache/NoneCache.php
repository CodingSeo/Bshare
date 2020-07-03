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
     * @param  int  $minutes
     *
     * @return bool
     */
    public function put($key, $value, $minutes){
        return false;
    }

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function get($key){
        return false;
    }

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function destroy($key){
        return false;
    }

    /**
     * @return bool
     */
    public function flush(){
        return false;
    }
    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key, Closure $callback, $ttl){
        $this->put($key, $value = $callback(), $ttl);
        return $value;
    }
}
