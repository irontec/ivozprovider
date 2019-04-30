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

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Cgr\Domain\Service\TpRatingPlan\UpdatedTpRatingPlanNotificator::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TpRatingPlanLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
