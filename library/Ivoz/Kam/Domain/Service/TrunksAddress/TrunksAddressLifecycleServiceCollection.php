<?php

namespace Ivoz\Kam\Domain\Service\TrunksAddress;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class TrunksAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksAddress\SendTrunksPermissionsReloadRequest::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, TrunksAddressLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
