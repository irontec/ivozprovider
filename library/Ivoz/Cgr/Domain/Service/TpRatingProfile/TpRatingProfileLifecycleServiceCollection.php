<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpRatingProfileLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Cgr\Domain\Service\TpRatingProfile\UpdatedTpRatingProfileNotificator::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TpRatingProfileLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
