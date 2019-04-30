<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class MusicOnHoldLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\MusicOnHold\SendRecodingOrder::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, MusicOnHoldLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
