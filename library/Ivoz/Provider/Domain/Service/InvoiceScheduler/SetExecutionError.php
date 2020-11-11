<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Service\FixedCostsRelInvoice\CreateByScheduler as FixedCostsRelInvoiceByScheduler;
use Psr\Log\LoggerInterface;

class SetExecutionError
{
    private $entityTools;
    protected $logger;
    protected $fixedCostsRelInvoiceByScheduler;
    protected $updateLastExecutionDate;

    public function __construct(
        EntityTools $entityTools,
        LoggerInterface $logger,
        FixedCostsRelInvoiceByScheduler $fixedCostsRelInvoiceByScheduler,
        UpdateLastExecutionDate $updateLastExecutionDate
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->fixedCostsRelInvoiceByScheduler = $fixedCostsRelInvoiceByScheduler;
        $this->updateLastExecutionDate = $updateLastExecutionDate;
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @param string $error | null
     *
     * @return void
     */
    public function execute(
        InvoiceSchedulerInterface $scheduler,
        $error = null
    ) {
        /** @var InvoiceSchedulerDto $invoiceSchedulerDto */
        $invoiceSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $invoiceSchedulerDto
            ->setLastExecutionError($error);

        $this->entityTools->updateEntityByDto(
            $scheduler,
            $invoiceSchedulerDto
        );
    }
}
