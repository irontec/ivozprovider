<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;

/**
 * Class CheckUniqueness
 * @package Ivoz\Provider\Domain\Service\Friend
 */
class CheckUniqueness implements FriendLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TerminalRepository $terminalRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * Check username and domain is unique in the whole platform
     *
     * @param FriendInterface $friend
     *
     * @return void
     */
    public function execute(FriendInterface $friend)
    {
        $terminal = $this->terminalRepository
            ->findOneByNameAndDomain(
                $friend->getName(),
                $friend->getDomain()
            );

        if ($terminal) {
            throw new \DomainException("There is already a terminal with that name.", 30008);
        }
    }
}
