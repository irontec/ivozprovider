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
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
