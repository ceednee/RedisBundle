<?php

namespace Highco\Bundle\RedisBundle\Entity\Serializer;

interface ISerializer
{
    public function serialize($data, $format);
    public function deserialize($type, $format);
}
