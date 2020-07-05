<?php

namespace App\Cache;

use Closure;

class MemcachedCache implements CacheContract
{

    /**
     *
     * @var Memcached
     */
    private $mcd;
    /**
     * @var int
     */
    private $expired_time;
    /**
     * @param string $con
     * @param int $port
     */
    public function __construct($con, $port)
    {
        $this->mcd = new \Memcached;
        $this->mcd->setOption(\Memcached::OPT_LIBKETAMA_COMPATIBLE, true);
        $this->mcd->addServer($con,$port);
        $this->expired_time = 120;
    }
    /**
     * @param  string  $key
     * @param  mixed  $value
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     *
     * @return bool
     */
    public function put($key, $value, $ttl = null){
        $ttl = $this->check_time($ttl);
        return $this->mcd->set($key, $value, $ttl);
    }

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function get($key){
        return $this->mcd->get($key);
    }

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function destroy($key){
        return $this->mcd->delete($key);
    }

    /**
     * @return void
     */
    public function flush(){
        $this->mcd->flush();
    }

    /**
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key, Closure $callback, $ttl = null)
    {
        $ttl = $this->check_time($ttl);
        $value = $this->get($key);
        if ($value) {
            return $value;
        }
        $this->put($key, $value = $callback(), $ttl);
        return $value;
    }

    /**
     * setting expired_time to default
     *
     * @param int|null $time
     * @return int
     */
    private function check_time($time){
        return (is_null($time))? $this->expired_time : $time;
    }
}
