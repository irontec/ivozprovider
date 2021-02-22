<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TransformationRuleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\TransformationRule\SendUsersDialplanReloadRequest::class => 100,
            \Ivoz\Provider\Domain\Service\TransformationRule\SendTrunksDialplanReloadRequest::class => 300,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TransformationRuleLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
