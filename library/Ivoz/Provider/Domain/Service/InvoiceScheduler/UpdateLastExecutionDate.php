<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

class UpdateLastExecutionDate
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @return void
     */
    public function execute(
        InvoiceSchedulerInterface $scheduler,
        $dispatchImmediately = true
    ) {
        /** @var InvoiceSchedulerDto $invoiceSchedulerDto */
        $invoiceSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $invoiceSchedulerDto
            ->setLastExecution(
                new \DateTime(
                    null,
                    new \DateTimeZone('UTC')
                )
            );

        $this->entityTools->persistDto(
            $invoiceSchedulerDto,
            $scheduler,
            $dispatchImmediately
        );
    }
}
