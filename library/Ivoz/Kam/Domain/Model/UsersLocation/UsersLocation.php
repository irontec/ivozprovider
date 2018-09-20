<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

/**
 * UsersLocation
 */
class UsersLocation extends UsersLocationAbstract implements UsersLocationInterface
{
    use UsersLocationTrait;

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
