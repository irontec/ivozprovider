<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

/**
 * UsersWatcher
 */
class UsersWatcher extends UsersWatcherAbstract implements UsersWatcherInterface
{
    use UsersWatcherTrait;

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
