<?php

namespace Ivoz\Provider\Domain\Service\BrandService;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class BrandServiceLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_remove" =>
        [
            \Ivoz\Provider\Domain\Service\CompanyService\RemoveByBrandService::class => 10,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, BrandServiceLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
