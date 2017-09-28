<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

/**
 * UsersWatcher
 */
class UsersWatcher extends UsersWatcherAbstract implements UsersWatcherInterface
{
    use UsersWatcherTrait;

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

