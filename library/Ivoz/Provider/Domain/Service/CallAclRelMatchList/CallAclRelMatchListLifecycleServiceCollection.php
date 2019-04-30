<?php

namespace Ivoz\Provider\Domain\Service\CallAclRelMatchList;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CallAclRelMatchListLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\CallAclRelMatchList\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, CallAclRelMatchListLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
