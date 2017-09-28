<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

/**
 * UsersXcap
 */
class UsersXcap extends UsersXcapAbstract implements UsersXcapInterface
{
    use UsersXcapTrait;

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

