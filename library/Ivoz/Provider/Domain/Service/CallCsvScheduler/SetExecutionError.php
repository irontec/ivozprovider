<?php

namespace Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;

class SetExecutionError
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     * @param string $error
     *
     * @return void
     */
    public function execute(CallCsvSchedulerInterface $scheduler, string $error)
    {
        /** @var CallCsvSchedulerDto $callCsvSchedulerDto */
        $callCsvSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $callCsvSchedulerDto
            ->setLastExecutionError($error);

        $this->entityTools->updateEntityByDto(
            $scheduler,
            $callCsvSchedulerDto
        );
    }
}
