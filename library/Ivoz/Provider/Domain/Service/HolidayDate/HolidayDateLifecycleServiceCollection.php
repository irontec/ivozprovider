<?php

namespace Ivoz\Provider\Domain\Service\HolidayDate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class HolidayDateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(HolidayDateLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
