<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

/**
 * UsersWatcher
 */
class UsersWatcher extends UsersWatcherAbstract implements UsersWatcherInterface
{
    use UsersWatcherTrait;

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

