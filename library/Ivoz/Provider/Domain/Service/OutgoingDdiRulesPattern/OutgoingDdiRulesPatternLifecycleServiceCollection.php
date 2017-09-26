<?php

namespace Ivoz\Provider\Domain\Service\OutgoingDdiRulesPattern;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class OutgoingDdiRulesPatternLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(OutgoingDdiRulesPatternLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}