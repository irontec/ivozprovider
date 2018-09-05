<?php

namespace Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;

interface CallCsvSchedulerLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CallCsvSchedulerInterface $entity, bool $isNew);
}