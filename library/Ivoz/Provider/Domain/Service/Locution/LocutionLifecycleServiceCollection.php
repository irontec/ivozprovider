<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class LocutionLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\Locution\SendRecodingOrder::class => 10,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, LocutionLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
