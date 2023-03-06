<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CarrierLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Cgr\Domain\Service\TpAccountAction\CreateByCarrier::class => 200,
            \Ivoz\Cgr\Domain\Service\TpCdrStat\CreateByCarrier::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\Carrier\SearchBrokenThresholds::class => 10,
            \Ivoz\Provider\Domain\Service\Carrier\SendCgratesReloadRequest::class => 200,
            \Ivoz\Provider\Domain\Service\Carrier\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, CarrierLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
