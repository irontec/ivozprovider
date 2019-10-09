<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigrated;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;
use Ivoz\Kam\Domain\Service\TrunksCdr\SetParsed;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;

class MigrateFromTrunksCdr
{
    protected $billableCallRepository;
    protected $createOrUpdateBillableCallByTrunksCdr;
    protected $domainEventPublisher;
    protected $entityTools;
    protected $setParsed;

    public function __construct(
        BillableCallRepository $billableCallRepository,
        CreateOrUpdateByTrunksCdr $createOrUpdateBillableCallByTrunksCdr,
        EntityTools $entityTools,
        DomainEventPublisher $domainEventPublisher,
        SetParsed $setParsed
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->createOrUpdateBillableCallByTrunksCdr = $createOrUpdateBillableCallByTrunksCdr;
        $this->domainEventPublisher = $domainEventPublisher;
        $this->entityTools = $entityTools;
        $this->setParsed = $setParsed;
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

        $this->setParsed->execute(
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
