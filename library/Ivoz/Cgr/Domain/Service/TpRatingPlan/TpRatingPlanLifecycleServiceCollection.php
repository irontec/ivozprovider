<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpRatingPlanLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TpRatingPlanLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}