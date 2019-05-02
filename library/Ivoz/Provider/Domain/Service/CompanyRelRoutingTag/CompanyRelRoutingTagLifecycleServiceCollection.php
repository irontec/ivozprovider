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

    /**
     * @return void
     */
    protected function addService(CompanyRelRoutingTagLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
