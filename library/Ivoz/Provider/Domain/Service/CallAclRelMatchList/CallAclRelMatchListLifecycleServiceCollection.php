<?php

namespace Ivoz\Provider\Domain\Service\CallAclRelMatchList;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CallAclRelMatchListLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(CallAclRelMatchListLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
