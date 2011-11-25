<?php

namespace Highco\Bundle\RedisBundle\Entity\Serializer;

use JMS\SerializerBundle\Serializer\SerializerInterface;

class JmsSerializerBridge implements ISerializer
{
    private $serializer;

    /**
     * __construct
     *
     * @param mixed $adapter
     * @access public
     * @return void
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * serialize
     *
     * @param mixed $data
     * @param mixed $format
     * @access public
     * @return void
     */
    public function serialize($data, $format)
    {
        return $this->serializer->serialize($data, $format);
    }

    /**
     * deserialize
     *
     * @param mixed $type
     * @param mixed $format
     * @access public
     * @return void
     */
    public function deserialize($type, $format)
    {
        exit('ici');
    }
}
