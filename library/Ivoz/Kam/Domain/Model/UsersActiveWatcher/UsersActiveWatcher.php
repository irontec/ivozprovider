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
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

