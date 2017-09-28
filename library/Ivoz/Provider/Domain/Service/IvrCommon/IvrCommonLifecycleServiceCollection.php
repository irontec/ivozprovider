<?php

namespace Ivoz\Provider\Domain\Service\IvrCommon;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class IvrCommonLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(IvrCommonLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}