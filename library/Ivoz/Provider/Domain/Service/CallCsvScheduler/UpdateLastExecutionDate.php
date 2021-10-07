<?php

namespace Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Psr\Log\LoggerInterface;

class UpdateLastExecutionDate
{
    public function __construct(
        private EntityTools $entityTools,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     * @return void
     */
    public function execute(
        CallCsvSchedulerInterface $scheduler,
        $dispatchImmediately = true
    ) {
        /** @var CallCsvSchedulerDto $callCsvSchedulerDto */
        $callCsvSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $callCsvSchedulerDto
            ->setLastExecution(
                new \DateTime(
                    'now',
                    new \DateTimeZone('UTC')
                )
            )
            ->setLastExecutionError('');

        $this->entityTools->persistDto(
            $callCsvSchedulerDto,
            $scheduler,
            $dispatchImmediately
        );
    }
}
