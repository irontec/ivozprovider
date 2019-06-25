<?php

namespace Ivoz\Provider\Domain\Service\DestinationRateGroup;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DestinationRateGroupLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\DestinationRateGroup\SendImporterOrder::class => 10,
            \Ivoz\Provider\Domain\Service\DestinationRateGroup\UpdatedDestinationRateGroupNotificator::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, DestinationRateGroupLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
