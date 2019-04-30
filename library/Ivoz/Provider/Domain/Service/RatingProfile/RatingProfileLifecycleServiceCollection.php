<?php

namespace Ivoz\Provider\Domain\Service\RatingProfile;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RatingProfileLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\RatingProfile\CheckValidCurrency::class => 200,
            \Ivoz\Cgr\Domain\Service\TpRatingProfile\UpdateByRatingProfile::class => 200,
            \Ivoz\Cgr\Domain\Service\TpRatingProfile\CreatedByCarrierRatingProfile::class => 201,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, RatingProfileLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
