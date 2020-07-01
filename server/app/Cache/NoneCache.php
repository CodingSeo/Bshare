<?php

namespace App\Cache;

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
}
