<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;

use Psr\Log\LoggerInterface;

class MigrateFromTrunksCdr
{
    const BATCH_SIZE = 100;

    /**
     * @var TrunksCdrRepository
     */
    protected $trunksCdrRepository;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var CreateOrUpdateDtoByTrunksCdr
     */
    protected $createOrUpdateBillableCallByTrunksCdr;

    /**
     * @var UpdateDtoByTpCdr
     */
    protected $updateBillableCallByTpCdr;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        TrunksCdrRepository  $trunksCdrRepository,
        BillableCallRepository $billableCallRepository,
        CreateOrUpdateDtoByTrunksCdr $createOrUpdateBillableCallByTrunksCdr,
        UpdateDtoByTpCdr $updateBillableCallByTpCdr,
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->trunksCdrRepository = $trunksCdrRepository;
        $this->billableCallRepository = $billableCallRepository;
        $this->createOrUpdateBillableCallByTrunksCdr = $createOrUpdateBillableCallByTrunksCdr;
        $this->updateBillableCallByTpCdr = $updateBillableCallByTpCdr;
        $this->entityTools = $entityTools;
        $this->logger = $logger;
    }

    public function execute()
    {
        /**
         * @var \Generator
         */
        $trunksGenerator = $this->trunksCdrRepository->getUnmeteredCallsGeneratorWithoutOffset(self::BATCH_SIZE);

        $cdrCount = 0;
        foreach ($trunksGenerator as $trunks) {
            if (empty($trunks)) {
                break;
            }

            foreach ($trunks as $trunkCdr) {
                $this->migrateToBillableCall($trunkCdr);
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

    private function migrateToBillableCall(TrunksCdrInterface $trunksCdr)
    {
        /**
         * @var BillableCallInterface $billableCall
         */
        $billableCall = $this->billableCallRepository->findOneByTrunksCdrId(
            $trunksCdr->getId()
        );

        $billableCallDto = $this
            ->createOrUpdateBillableCallByTrunksCdr
            ->execute(
                $trunksCdr,
                $billableCall
            );

        $this->updateBillableCallByTpCdr->execute(
            $billableCallDto,
            $trunksCdr->getCgrid(),
            ucfirst($trunksCdr->getBrand()->getLanguageCode())
        );

        $this->entityTools->persistDto(
            $billableCallDto,
            $billableCall,
            false
        );

        /**
         * @var TrunksCdrDto $trunksCdrDto
         */
        $trunksCdrDto = $this->entityTools->entityToDto(
            $trunksCdr
        );
        $trunksCdrDto->setMetered(true);
        $this->entityTools->persistDto(
            $trunksCdrDto,
            $trunksCdr,
            false
        );
    }
}
