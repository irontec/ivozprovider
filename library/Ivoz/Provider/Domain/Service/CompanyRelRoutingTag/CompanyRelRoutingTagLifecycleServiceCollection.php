<?php

namespace Ivoz\Provider\Domain\Service\CompanyRelRoutingTag;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CompanyRelRoutingTagLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\CompanyRelRoutingTag\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, CompanyRelRoutingTagLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
