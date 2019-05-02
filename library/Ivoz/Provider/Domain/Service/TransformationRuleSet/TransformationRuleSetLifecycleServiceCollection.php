<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TransformationRuleSetLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(TransformationRuleSetLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
