<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelBrand;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FeaturesRelBrandLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(FeaturesRelBrandLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
