<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

/**
 * UsersPua
 */
class UsersPua extends UsersPuaAbstract implements UsersPuaInterface
{
    use UsersPuaTrait;

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
