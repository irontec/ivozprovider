<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

/**
 * UsersXcap
 */
class UsersXcap extends UsersXcapAbstract implements UsersXcapInterface
{
    use UsersXcapTrait;

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

