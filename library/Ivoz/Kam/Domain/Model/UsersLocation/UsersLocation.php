<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

/**
 * UsersLocation
 */
class UsersLocation extends UsersLocationAbstract implements UsersLocationInterface
{
    use UsersLocationTrait;

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

