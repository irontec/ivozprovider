<?php
namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

/**
 * UsersActiveWatcher
 */
class UsersActiveWatcher extends UsersActiveWatcherAbstract implements UsersActiveWatcherInterface
{
    use UsersActiveWatcherTrait;

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
