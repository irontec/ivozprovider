<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelSchedule;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelScheduleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(ConditionalRoutesConditionsRelScheduleLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
