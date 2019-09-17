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

class MigrateFromTrunksCdr
{
    protected $billableCallRepository;
    protected $createOrUpdateBillableCallByTrunksCdr;
    protected $domainEventPublisher;
    protected $entityTools;

    public function __construct(
        BillableCallRepository $billableCallRepository,
        CreateOrUpdateByTrunksCdr $createOrUpdateBillableCallByTrunksCdr,
        EntityTools $entityTools,
        DomainEventPublisher $domainEventPublisher
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->createOrUpdateBillableCallByTrunksCdr = $createOrUpdateBillableCallByTrunksCdr;
        $this->domainEventPublisher = $domainEventPublisher;
        $this->entityTools = $entityTools;
    }

    /**
     * @return void
     */
    public function execute(TrunksCdrInterface $trunksCdr, $dispatchImmediately = false)
    {
        /**
         * @var BillableCallInterface $billableCall
         */
        $billableCall = $this->billableCallRepository->findOneByTrunksCdrId(
            $trunksCdr->getId()
        );

        $billableCall = $this
            ->createOrUpdateBillableCallByTrunksCdr
            ->execute(
                $trunksCdr,
                $billableCall
            );

        $this->entityTools->persist(
            $billableCall,
            $dispatchImmediately
        );

        /**
         * @var TrunksCdrDto $trunksCdrDto
         */
        $trunksCdrDto = $this->entityTools->entityToDto(
            $trunksCdr
        );
        $trunksCdrDto->setParsed(true);
        $this->entityTools->persistDto(
            $trunksCdrDto,
            $trunksCdr,
            $dispatchImmediately
        );

        $trunksCdrWasMigrated = new TrunksCdrWasMigrated(
            $trunksCdr,
            $billableCall
        );

        $this->domainEventPublisher->publish(
            $trunksCdrWasMigrated
        );
    }
}
