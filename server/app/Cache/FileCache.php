<?php

namespace App\Cache;

class FileCache implements CacheContract
{

    /**
     *
     * @var Memcached
     */
    private $mcd;
    /**
     * @param string $con
     * @param int $port
     */
    public function __construct($con, $port)
    {
        // $this->mcd = new \Memcached();
        // $this->mcd->setOption(\Memcached::OPT_LIBKETAMA_COMPATIBLE, true);
        // $this->mcd->addServer($con,$port);
    }
    /**
     * @param  string  $key
     * @param  mixed  $value
     * @param  int  $minutes
     *
     * @return void
     */
    public function add($key, $value, $minutes){
        $this->mcd->set($key, $value, $minutes);
    }

    /**
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return void
     */
    public function forever($key, $value){
        $infitiy = 1;
        $this->mcd->set($key, $value, $infitiy);
    }

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function get($key){
        $this->mcd->get($key);
    }

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function destroy($key){
        return $this->mcd->detele($key);
    }

    /**
     * @return void
     */
    public function flush(){
        return $this->mcd->flush();
    }
}
