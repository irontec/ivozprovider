<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

/**
 * UsersActiveWatcher
 */
class UsersActiveWatcher extends UsersActiveWatcherAbstract implements UsersActiveWatcherInterface
{
    use UsersActiveWatcherTrait;

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
