<?php

namespace Ivoz\Kam\Domain\Model\UsersDomainAttr;

/**
 * UsersDomainAttr
 */
class UsersDomainAttr extends UsersDomainAttrAbstract implements UsersDomainAttrInterface
{
    use UsersDomainAttrTrait;

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

