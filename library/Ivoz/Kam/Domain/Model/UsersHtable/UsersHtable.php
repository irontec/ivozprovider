<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

/**
 * UsersHtable
 */
class UsersHtable extends UsersHtableAbstract implements UsersHtableInterface
{
    use UsersHtableTrait;

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

