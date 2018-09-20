<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

/**
 * UsersXcap
 */
class UsersXcap extends UsersXcapAbstract implements UsersXcapInterface
{
    use UsersXcapTrait;

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
