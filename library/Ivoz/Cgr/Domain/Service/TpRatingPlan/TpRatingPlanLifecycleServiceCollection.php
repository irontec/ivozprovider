<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Assert\Assertion;
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

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, TpRatingPlanLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
