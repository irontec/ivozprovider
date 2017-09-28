<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

/**
 * ProxyUser
 */
class ProxyUser extends ProxyUserAbstract implements ProxyUserInterface
{
    use ProxyUserTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

