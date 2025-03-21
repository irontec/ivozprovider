<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RatingPlanLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
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

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, RatingPlanLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
