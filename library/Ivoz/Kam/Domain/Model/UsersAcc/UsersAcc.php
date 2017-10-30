<?php

namespace Ivoz\Kam\Domain\Model\UsersAcc;

/**
 * UsersAcc
 */
class UsersAcc extends UsersAccAbstract implements UsersAccInterface
{
    use UsersAccTrait;

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

