<?php

namespace Ivoz\Provider\Domain\Service\CompanyRelCodec;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CompanyRelCodecLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\CompanyRelCodec\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, CompanyRelCodecLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
