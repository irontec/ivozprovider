<?php

namespace Ivoz\Kam\Domain\Service\TrunksCdr;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TrunksCdrLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_domain_event" =>
        [
            0 => \Ivoz\Provider\Domain\Service\BillableCall\UpdateByTpCdr::class,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, $service)
    {
        $this->services[$event][] = $service;
    }
}
