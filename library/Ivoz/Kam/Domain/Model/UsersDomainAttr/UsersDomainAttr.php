<?php

namespace Ivoz\Kam\Domain\Model\UsersDomainAttr;

/**
 * UsersDomainAttr
 */
class UsersDomainAttr extends UsersDomainAttrAbstract implements UsersDomainAttrInterface
{
    use UsersDomainAttrTrait;

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

