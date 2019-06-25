<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpDestinationRateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Cgr\Domain\Service\TpDestinationRate\UpdatedTpDestinationRateNotificator::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TpDestinationRateLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
