<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrRepository;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Kam\Domain\Service\TrunksCdr\RerateCallServiceInterface;
use Ivoz\Provider\Domain\Service\BillableCall\MigrateFromTrunksCdr;

class AutoRateCalls implements InvoiceLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = CheckValidity::PRE_PERSIST_PRIORITY - 1;

    protected $billableCallRepository;
    protected $rerateCallService;
    protected $migrateFromTrunksCdr;
    protected $entityTools;

    public function __construct(
        BillableCallRepository $billableCallRepository,
        RerateCallServiceInterface $rerateCallService,
        MigrateFromTrunksCdr $migrateFromTrunksCdr,
        EntityTools $entityTools
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->rerateCallService = $rerateCallService;
        $this->migrateFromTrunksCdr = $migrateFromTrunksCdr;
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @param InvoiceInterface $invoice
     */
    public function execute(InvoiceInterface $invoice)
    {
        if (!$invoice->getScheduler()) {
            return;
        }

        $utcTz = new \DateTimeZone('UTC');
        $utcInDate = $invoice->getInDate()->setTimezone($utcTz);
        $utcOutDate = $invoice->getOutDate()->setTimezone($utcTz);

        $this->tryToRateCalls($invoice, $utcInDate, $utcOutDate);
    }

    /**
     * @param InvoiceInterface $invoice
     * @param \DateTime $utcInDate
     * @param \DateTime $utcOutDate
     */
    private function tryToRateCalls(InvoiceInterface $invoice, \DateTime $utcInDate, \DateTime $utcOutDate)
    {
        $unmeteredCallArguments = [
            $invoice->getCompany()->getId(),
            $invoice->getBrand()->getId(),
            $utcInDate->format('Y-m-d H:i:s'),
            $utcOutDate->format('Y-m-d H:i:s')
        ];

        $untarificattedCallIds = $this->billableCallRepository->getUntarificattedCallIdsInRange(
            ...$unmeteredCallArguments
        );

        if (empty($untarificattedCallIds)) {
            return;
        }

        try {
            $this->rerateCallService->execute($untarificattedCallIds);

            foreach ($untarificattedCallIds as $id) {
                $billableCall = $this->billableCallRepository->find($id);
                $trunksCdr = $billableCall->getTrunksCdr();
                if (!$trunksCdr) {
                    continue;
                }

                $this->migrateFromTrunksCdr->execute($trunksCdr);
            }

            $this->entityTools->dispatchQueuedOperations();
        } catch (\Exception $e) {
        }
    }
}
