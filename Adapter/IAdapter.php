<?php

namespace Highco\Bundle\RedisBundle\Adapter;

interface IAdapter
{
    public function __construct(array $connection, array $options = array());
    public function generateKey($key, $identifier = null, $suffix = null); //should be used to add prefix or other thinx
}
