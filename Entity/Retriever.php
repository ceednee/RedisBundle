<?php

namespace Highco\Bundle\RedisBundle\Entity;

class Retriever
{
    protected $adapter;

    /**
     * __construct
     *
     * @param mixed $adapter
     * @access public
     * @return void
     */
    public function __construct($adapter)
    {
        $this->setAdapter($adapter);
    }

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }
}
