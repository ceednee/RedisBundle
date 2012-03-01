<?php

namespace Highco\Bundle\RedisBundle\Entity;

use Highco\Bundle\RedisBundle\Adapter\IAdapter as IRedisAdapter;
use Highco\Bundle\RedisBundle\Entity\Serializer\ISerializer as IEntitySerializer;

class Persister
{
    private $adapter;
    private $serializer;

    /**
     * __construct
     *
     * @param IRedisAdapter $adapter
     * @param IEntitySerializer $serializer
     * @access public
     * @return void
     */
    public function __construct(IRedisAdapter $adapter, IEntitySerializer $serializer)
    {
        $this->adapter = $adapter;
        $this->serializer = $serializer;
    }

    /**
     * persist
     *
     * @param mixed $entity
     * @param string $format
     * @access public
     * @return void
     */
    public function persist(IRedisEntity $entity, $format = 'json')
    {
        $data = $this->serializer->serialize($entity->getDataToPersist(), $format);
        $key  = $this->adapter->generateKey($entity->getRedisKey(), $entity->getRedisIdentifier());

        return $this->adapter->set($key, $data);
    }
}
