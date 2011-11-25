<?php

namespace Highco\Bundle\RedisBundle\Entity;

interface IRedisEntity
{
    public function getRedisKey();
    public function getRedisIdentifier();
    public function getDataToPersist();

}
