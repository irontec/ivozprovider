<?php

namespace Ivoz\Cgr\Domain\Service\TpLcrRule;

use Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpLcrRuleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Cgr\Domain\Service\TpLcrRule\UpdatedTpLcrRuleNotificator::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, TpLcrRuleLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
