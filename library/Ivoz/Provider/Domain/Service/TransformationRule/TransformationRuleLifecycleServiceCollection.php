<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Assert\Assertion;
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

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, TransformationRuleLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
