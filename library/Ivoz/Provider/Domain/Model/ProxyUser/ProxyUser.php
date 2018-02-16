<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

/**
 * ProxyUser
 */
class ProxyUser extends ProxyUserAbstract implements ProxyUserInterface
{
    use ProxyUserTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

