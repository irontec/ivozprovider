<?php

namespace Ivoz\Provider\Domain\Service\BannedAddress;

use Ivoz\Kam\Infrastructure\Kamailio\UsersClient;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddressInterface;
use Psr\Log\LoggerInterface;

class Unban implements BannedAddressLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_HIGH;

    public function __construct(
        private UsersClient $kamUsersClient,
        private LoggerInterface $logger
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    public function execute(BannedAddressInterface $bannedAddress): void
    {
        $blockedByAntibruteForce = $bannedAddress->getBlocker() === BannedAddressInterface::BLOCKER_ANTIBRUTEFORCE;
        if (! $blockedByAntibruteForce) {
            return;
        }

        try {
            $this->kamUsersClient->unban(
                $bannedAddress->getAor(),
                $bannedAddress->getIp()
            );
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            throw $e;
        }
    }
}
