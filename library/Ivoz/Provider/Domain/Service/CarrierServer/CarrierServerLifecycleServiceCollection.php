<?php

namespace Ivoz\Provider\Domain\Service\CarrierServer;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CarrierServerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByCarrierServer::class => 10,
            \Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\UpdateByCarrierServer::class => 20,
        ],
        "post_remove" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\UpdateByCarrierServer::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Infrastructure\Domain\Service\CarrierServer\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, CarrierServerLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
