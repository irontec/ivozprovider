<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CarrierLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Carrier\ForceExternallyRated::class => 200,
        ],
        "post_persist" =>
        [
            \Ivoz\Cgr\Domain\Service\TpAccountAction\CreateByCarrier::class => 200,
            \Ivoz\Cgr\Domain\Service\TpCdrStat\CreateByCarrier::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\Carrier\SearchBrokenThresholds::class => 10,
            \Ivoz\Provider\Domain\Service\Carrier\SendCgratesReloadRequest::class => 200,
            \Ivoz\Provider\Domain\Service\Carrier\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, CarrierLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
