<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

/**
 * UsersPua
 */
class UsersPua extends UsersPuaAbstract implements UsersPuaInterface
{
    use UsersPuaTrait;

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

