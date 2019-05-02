<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelCalendarLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(ConditionalRoutesConditionsRelCalendarLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
