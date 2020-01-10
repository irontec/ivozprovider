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

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\RatingPlan\CheckValidCurrency::class => 200,
        ],
        "post_persist" =>
        [
            \Ivoz\Cgr\Domain\Service\TpRatingPlan\UpdateByRatingPlan::class => 200,
            \Ivoz\Cgr\Domain\Service\TpTiming\CreatedByRatingPlan::class => 200,
            \Ivoz\Cgr\Domain\Service\TpTiming\DeletedByRatingPlan::class => 200,
            \Ivoz\Provider\Domain\Service\RatingPlan\CheckDestinationRateGroupDuplicates::class => 200,
        ],
        "error_handler" =>
        [
            \Ivoz\Provider\Domain\Service\RatingPlan\PersistErrorHandler::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, RatingPlanLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
