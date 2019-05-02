<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelCalendar;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ExternalCallFilterRelCalendarLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(ExternalCallFilterRelCalendarLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
