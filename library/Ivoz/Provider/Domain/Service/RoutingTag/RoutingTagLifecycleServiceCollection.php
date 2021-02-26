<?php

namespace Ivoz\Provider\Domain\Service\RoutingTag;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RoutingTagLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByRoutingTag::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\RoutingTag\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, RoutingTagLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
