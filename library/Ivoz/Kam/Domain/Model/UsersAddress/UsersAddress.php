<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

/**
 * UsersAddres
 */
class UsersAddress extends UsersAddressAbstract implements UsersAddressInterface
{
    use UsersAddressTrait;

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

