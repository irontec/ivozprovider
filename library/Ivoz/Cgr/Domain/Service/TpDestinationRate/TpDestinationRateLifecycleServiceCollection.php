<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
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

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, TpDestinationRateLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
