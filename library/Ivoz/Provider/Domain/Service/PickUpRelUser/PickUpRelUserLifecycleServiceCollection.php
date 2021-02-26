<?php

namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class PickUpRelUserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\PickUpRelUser\AvoidUpdates::class => 100,
        ],
        "post_persist" =>
        [
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByPickUpRelUser::class => 10,
        ],
        "post_remove" =>
        [
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByPickUpRelUser::class => 10,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, PickUpRelUserLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
