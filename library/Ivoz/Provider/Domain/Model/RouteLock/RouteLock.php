<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Assert\Assertion;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
 * RouteLock
 */
class RouteLock extends RouteLockAbstract implements RouteLockInterface
{
    use RouteLockTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['password'])) {
            $changeSet['password'] = '****';
        }

        return $changeSet;
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

    /**
     * Return in current lock status is open
     *
     * @return boolean
     */
    public function isOpen()
    {
        return $this->getOpen() == '1';
    }
}
