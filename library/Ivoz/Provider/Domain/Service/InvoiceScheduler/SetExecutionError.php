<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

class SetExecutionError
{
    public function __construct(
        private EntityTools $entityTools,
    ) {
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
