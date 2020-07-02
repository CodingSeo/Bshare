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
     * @return void
     */
    public function add($key, $value, $minutes){

    }

    /**
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return void
     */
    public function forever($key, $value){
    }

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function get($key){
        return null;
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
     * @return void
     */
    public function flush(){

    }
    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key, $ttl, Closure $callback){
        return null;
    }
}
