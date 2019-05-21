<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RatingPlanLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(RatingPlanLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
