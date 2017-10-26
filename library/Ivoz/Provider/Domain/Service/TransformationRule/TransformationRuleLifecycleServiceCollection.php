<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class TransformationRuleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TransformationRuleLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}