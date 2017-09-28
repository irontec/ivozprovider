<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

/**
 * UsersAddres
 */
class UsersAddress extends UsersAddressAbstract implements UsersAddressInterface
{
    use UsersAddressTrait;

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

