<?php
namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

/**
 * UsersActiveWatcher
 */
class UsersActiveWatcher extends UsersActiveWatcherAbstract implements UsersActiveWatcherInterface
{
    use UsersActiveWatcherTrait;

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

