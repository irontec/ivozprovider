<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

/**
 * UsersMissedCall
 */
class UsersMissedCall extends UsersMissedCallAbstract implements UsersMissedCallInterface
{
    use UsersMissedCallTrait;

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

