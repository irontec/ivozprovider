<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

/**
 * UsersCdr
 */
class UsersCdr extends UsersCdrAbstract implements UsersCdrInterface
{
    use UsersCdrTrait;

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

