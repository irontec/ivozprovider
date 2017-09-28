<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

/**
 * UsersMissedCall
 */
class UsersMissedCall extends UsersMissedCallAbstract implements UsersMissedCallInterface
{
    use UsersMissedCallTrait;

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

