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

    protected function addService(BrandServiceLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}