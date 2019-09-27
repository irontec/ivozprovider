<?php

namespace Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Psr\Log\LoggerInterface;

class UpdateLastExecutionDate
{
    private $entityTools;
    protected $logger;

    public function __construct(
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
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
                    null,
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
