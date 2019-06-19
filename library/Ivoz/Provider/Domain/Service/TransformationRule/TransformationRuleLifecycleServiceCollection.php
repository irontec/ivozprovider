<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TransformationRuleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(TransformationRuleLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
