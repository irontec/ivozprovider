<?php

namespace Ivoz\Provider\Domain\Service\CarrierServer;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CarrierServerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByCarrierServer::class => 10,
            \Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\UpdateByCarrierServer::class => 20,
        ],
        "post_remove" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\UpdateByCarrierServer::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\CarrierServer\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, CarrierServerLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
