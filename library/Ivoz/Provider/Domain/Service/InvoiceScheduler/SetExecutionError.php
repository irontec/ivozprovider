<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

class SetExecutionError
{
    private const MAX_RETRIES_ON_ERROR = 3;

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
        ?string $error = null
    ) {
        /** @var InvoiceSchedulerDto $invoiceSchedulerDto */
        $invoiceSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $maxRetriesReached = $scheduler->getErrorCount() >= self::MAX_RETRIES_ON_ERROR;
        $mustResetError = is_null($error) || $maxRetriesReached;

        $errorCount = $mustResetError
            ? 0
            : $scheduler->getErrorCount() + 1;

        $invoiceSchedulerDto
            ->setErrorCount(
                $errorCount,
            );

        $cleanError = !$maxRetriesReached && $errorCount > 0;
        $errorMsg = $cleanError
            ? null
            : $error;

        $invoiceSchedulerDto
            ->setLastExecutionError(
                $errorMsg,
            );

        $this->entityTools->updateEntityByDto(
            $scheduler,
            $invoiceSchedulerDto
        );
    }
}
