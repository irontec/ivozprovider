<?php

namespace Ivoz\Provider\Domain\Service\BannedAddress;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Infrastructure\Kamailio\UsersClient;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddressInterface;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddressRepository;
use Psr\Log\LoggerInterface;

class Unban implements BannedAddressLifecycleEventHandlerInterface
{
    const PRE_REMOVE_PRIORITY = self::PRIORITY_HIGH;

    protected $entityTools;
    protected $bannedAddressRepository;
    protected $kamUsersClient;
    protected $logger;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    public function __construct(
        EntityTools $entityTools,
        BannedAddressRepository $bannedAddressRepository,
        UsersClient $kamUsersClient,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->bannedAddressRepository = $bannedAddressRepository;
        $this->kamUsersClient = $kamUsersClient;
        $this->logger = $logger;
    }

    public function execute(BannedAddressInterface $bannedAddress)
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
