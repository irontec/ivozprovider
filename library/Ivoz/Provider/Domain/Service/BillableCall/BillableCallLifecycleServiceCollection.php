<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class BillableCallLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
    ];

    /**
     * @return void
     */
    protected function addService(string $event, $service)
    {
        $this->services[$event][] = $service;
    }
}
