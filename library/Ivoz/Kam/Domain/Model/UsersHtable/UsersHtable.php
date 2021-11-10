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
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
