<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

/**
 * UsersMissedCall
 */
class UsersMissedCall extends UsersMissedCallAbstract implements UsersMissedCallInterface
{
    use UsersMissedCallTrait;

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

