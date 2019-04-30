<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelCompany;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FeaturesRelCompanyLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\FeaturesRelCompany\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, FeaturesRelCompanyLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
