<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpAccountActionLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, TpAccountActionLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
