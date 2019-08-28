<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Psr\Log\LoggerInterface;

class MigrateFromUnparsedTrunksCdr
{
    const BATCH_SIZE = 100;

    protected $trunksCdrRepository;
    protected $entityTools;
    protected $migrateFromTrunksCdr;
    protected $logger;

    public function __construct(
        TrunksCdrRepository  $trunksCdrRepository,
        EntityTools $entityTools,
        MigrateFromTrunksCdr $migrateFromTrunksCdr,
        LoggerInterface $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->entityTools = $entityTools;
        $this->migrateFromTrunksCdr = $migrateFromTrunksCdr;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function execute()
    {
        /**
         * @var \Generator
         */
        $trunksGenerator = $this->trunksCdrRepository->getUnparsedCallsGeneratorWithoutOffset(self::BATCH_SIZE);

        $cdrCount = 0;
        foreach ($trunksGenerator as $trunks) {
            if (empty($trunks)) {
                break;
            }

            foreach ($trunks as $trunkCdr) {
                $this->migrateFromTrunksCdr->execute($trunkCdr);
            }

            try {
                $this->entityTools->dispatchQueuedOperations();
                $cdrCount += count($trunks);
            } catch (\Exception $e) {
                $this->logger->error('BillableCall migration service error:: ' . $e->getMessage());
                // Keep going
            }
        }

        $this->logger->info('BillableCall migration service has migrated ' . $cdrCount . ' successfully');
    }
}
