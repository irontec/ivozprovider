<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpRateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Cgr\Domain\Service\TpRate\UpdatedTpRateNotificator::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TpRateLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
