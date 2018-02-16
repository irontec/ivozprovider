<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

/**
 * UsersHtable
 */
class UsersHtable extends UsersHtableAbstract implements UsersHtableInterface
{
    use UsersHtableTrait;

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

