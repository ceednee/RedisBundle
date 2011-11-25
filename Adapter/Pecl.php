<?php

namespace Highco\Bundle\RedisBundle\Adapter;

class Pecl extends AbstractAdapter implements IAdapter
{
    protected $redis;

    /**
     * initialize
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
        if(false === class_exists('Redis'))
            throw new \Exception('Redis pecl lib is not yet installed');

        $method      = $this->getOption('persistent', true) ? 'pconnect' : 'connect';

        $this->redis = new \Redis();
        $this->redis->$method(
            $this->getParameter('host'),
            $this->getParameter('port'),
            $this->getParameter('timeout')
        );

        $this->redis->select($this->getParameter('database', 0));
    }


    /**
     * getRedis
     *
     * @access public
     * @return void
     */
    public function getRedis()
    {
        if(is_null($this->redis))
            $this->initialize();

        return $this->redis;
    }

    /**
     * __call
     *
     * @param mixed $method
     * @param mixed $args
     * @access public
     * @return void
     */
    public function __call($method, $args)
    {
        return call_user_func_array(array($this->getRedis(), $method), $args);
    }
}
