<?php

namespace Ivoz\Kam\Domain\Model\UsersDomainAttr;

/**
 * UsersDomainAttr
 */
class UsersDomainAttr extends UsersDomainAttrAbstract implements UsersDomainAttrInterface
{
    use UsersDomainAttrTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

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

