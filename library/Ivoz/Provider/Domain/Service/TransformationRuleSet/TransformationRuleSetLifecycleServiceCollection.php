<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TransformationRuleSetLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
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

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, TransformationRuleSetLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
