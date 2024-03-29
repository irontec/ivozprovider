<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

/**
 * Class CheckUniqueness
 * @package Ivoz\Provider\Domain\Service\Terminal
 */
class CheckUniqueness implements TerminalLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private FriendRepository $friendRepository
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
     * @param TerminalInterface $terminal
     *
     * @return void
     */
    public function execute(TerminalInterface $terminal)
    {
        $friend = $this->friendRepository
            ->findOneByNameAndDomain(
                $terminal->getName(),
                $terminal->getDomain()
            );

        if ($friend) {
            throw new \DomainException("There is already a friend with that name.", 30007);
        }
    }
}
