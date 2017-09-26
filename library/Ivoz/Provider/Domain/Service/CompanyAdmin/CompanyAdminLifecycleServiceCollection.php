<?php

namespace Ivoz\Provider\Domain\Service\CompanyAdmin;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class CompanyAdminLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(CompanyAdminLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}