<?php

namespace Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class TransformationRulesetGroupsTrunkLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}