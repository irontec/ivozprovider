<?php

namespace Ivoz\Kam\Domain\Model\UsersAcc;

/**
 * UsersAcc
 */
class UsersAcc extends UsersAccAbstract implements UsersAccInterface
{
    use UsersAccTrait;

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

