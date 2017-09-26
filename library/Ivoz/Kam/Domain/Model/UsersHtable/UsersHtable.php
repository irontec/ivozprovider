<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

/**
 * UsersHtable
 */
class UsersHtable extends UsersHtableAbstract implements UsersHtableInterface
{
    use UsersHtableTrait;

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

