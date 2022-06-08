<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Cgr\Domain\Model\TpCdr\TpCdrRepository;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\ProcessExternalCdr;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigratedSubscriberInterface;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Psr\Log\LoggerInterface;

class UpdateByTpCdr implements TrunksCdrWasMigratedSubscriberInterface
{
    public function __construct(
        private TpCdrRepository $tpCdrRepository,
        private UpdateDtoByDefaultRunTpCdr $updateDtoByDefaultRunTpCdr,
        private ProcessExternalCdr $processExternalCdr,
        private EntityTools $entityTools,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param DomainEventInterface $domainEvent
     * @return boolean
     */
    public function isSubscribedTo(DomainEventInterface $domainEvent)
    {
        return $domainEvent instanceof TrunksCdrWasMigrated;
    }

    /**
     * @param TrunksCdrWasMigrated $domainEvent
     * @throws \Exception
     * @return void
     */
    public function handle(DomainEventInterface $domainEvent)
    {
        if (!($domainEvent instanceof TrunksCdrWasMigrated)) {
            throw new \Exception('TrunksCdrWasMigrated was expected');
        }

        $trunksCdr = $domainEvent->getTrunksCdr();
        $billableCall = $domainEvent->getBillableCall();

        $isNotOutbound = !$billableCall->isOutboundCall();
        if ($isNotOutbound) {
            $msg = sprintf(
                'Skipping %s call #%d',
                $billableCall->getDirection(),
                (int) $billableCall->getId()
            );
            $this->logger->info($msg);

            return;
        }

        $infoMsg = sprintf(
            'About to update billable call by TpCdr. TrunksCdr#%s',
            (int) $trunksCdr->getId()
        ) ;
        $this->logger->info($infoMsg);

        $this->execute(
            $trunksCdr,
            $billableCall
        );
    }

    /**
     * @param BillableCallInterface $billableCall
     * @return void
     */
    protected function execute(
        TrunksCdrInterface $trunksCdr,
        BillableCallInterface $billableCall
    ) {
        $cgrid = $trunksCdr->getCgrid();
        if (!$cgrid) {
            try {
                $processed = $this->processExternalCdr->execute($trunksCdr);
                if ($processed) {
                    $cgrid = $trunksCdr->getCgrid();
                }
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }

        if (!$cgrid) {
            $this->logger->info('Cgrid was not found. Skipping');
            return;
        }

        $carrier = $billableCall->getCarrier();
        if ($carrier && $carrier->getExternallyRated()) {
            $infoMsg = sprintf(
                'Carrier#%s has external rater. Skipping',
                (int) $carrier->getId()
            );
            $this->logger->info($infoMsg);
            return;
        }

        $defaultRunTpCdr = $this->tpCdrRepository->getDefaultRunByCgrid(
            $cgrid
        );

        if (!$defaultRunTpCdr) {
            $errorMsg = sprintf(
                'No default run TpCdr found for cgrid %s. Skipping',
                $cgrid
            );
            $this->logger->error($errorMsg);
            return;
        }

        /** @var BillableCallDto $billableCallDto */
        $billableCallDto = $this->entityTools->entityToDto($billableCall);
        $billableCallDto = $this->updateDtoByDefaultRunTpCdr->execute(
            $billableCallDto,
            $trunksCdr,
            $defaultRunTpCdr
        );

        $carrierRunTpCdr = $this->tpCdrRepository->getCarrierRunByCgrid(
            $cgrid
        );

        if ($carrierRunTpCdr) {
            $billableCallDto->setCost(
                $carrierRunTpCdr->getCost()
            );
        } elseif ($trunksCdr->getBounced()) {
            $billableCallDto
                ->setCost(0);
        }

        $this->entityTools->persistDto(
            $billableCallDto,
            $billableCall,
            false
        );
    }
}
