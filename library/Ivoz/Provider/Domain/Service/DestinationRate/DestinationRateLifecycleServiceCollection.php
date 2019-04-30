<?php

namespace Ivoz\Provider\Domain\Service\DestinationRate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DestinationRateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Cgr\Domain\Service\TpRate\UpdatedByDestinationRate::class => 200,
            \Ivoz\Cgr\Domain\Service\TpDestinationRate\UpdatedByDestinationRate::class => 201,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, DestinationRateLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
