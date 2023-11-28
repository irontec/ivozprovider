<?php

namespace Ivoz\Provider\Application\Service\UsersCdr;

use Ivoz\Core\Domain\Model\Commandlog\Commandlog;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Provider\Domain\Service\UsersCdr\MigrateFromKamUsersCdr;
use Psr\Log\LoggerInterface;

class MigrateFromUnparsedKamUsersCdr
{
    public const BATCH_SIZE = 100;

    public function __construct(
        private UsersCdrRepository $usersCdrRepository,
        private EntityTools $entityTools,
        private MigrateFromKamUsersCdr $migrateFromKamUsersCdr,
        private LoggerInterface $logger
    ) {
    }

    public function execute(): void
    {
        $usersGenerator = $this->usersCdrRepository->getUnparsedCallsGeneratorWithoutOffset(
            self::BATCH_SIZE
        );

        $cdrCount = 0;
        foreach ($usersGenerator as $usersCdrs) {
            if (empty($usersCdrs)) {
                break;
            }

            foreach ($usersCdrs as $userCdr) {
                $this->migrateFromKamUsersCdr->execute(
                    $userCdr,
                    false
                );
            }

            try {
                $this->entityTools->dispatchQueuedOperations();
                $this->entityTools->clearExcept(
                    Commandlog::class
                );

                $cdrCount += count($usersCdrs);
            } catch (\Exception $e) {
                $this->logger->error('UsersCdr migration service error:: ' . $e->getMessage());
                // Keep going
            }
        }

        $this->logger->info('UsersCdr migration service has migrated ' . $cdrCount . ' successfully');
    }
}
