<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TransformationRuleSetLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\TransformationRule\GenerateRules::class => 10,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\TransformationRuleSet\SendUsersDialplanReloadRequest::class => 100,
            \Ivoz\Provider\Domain\Service\TransformationRuleSet\SendTrunksDialplanReloadRequest::class => 300,
        ],
    ];


    protected function addService(string $event, TransformationRuleSetLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
