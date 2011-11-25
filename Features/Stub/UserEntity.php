<?php

namespace Highco\Bundle\RedisBundle\Features\Stub;

use Highco\Bundle\RedisBundle\Entity\IRedisEntity;

class UserEntity implements IRedisEntity
{
    protected $username;
    protected $firstname;
    protected $lastname;

    public function getRedisKey()
    {
        return 'user';
    }

    public function getRedisIdentifier()
    {
        return 1;
    }

    public function getDataToPersist()
    {
        return $this;
    }

    /**
     * hydrate
     *
     * @param mixed $values
     * @access public
     * @return void
     */
    public function hydrate($values)
    {
        $this->username = $values['username'];
        $this->firstname = $values['firstname'];
        $this->lastname = $values['lastname'];
    }
}
