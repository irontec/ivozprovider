<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;

/**
 * Class CheckUniqueness
 * @package Ivoz\Provider\Domain\Service\Friend
 */
class CheckUniqueness implements FriendLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var TerminalRepository
     */
    protected $terminalRepository;

    public function __construct(
        TerminalRepository $terminalRepository
    ) {
        $this->terminalRepository = $terminalRepository;
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
