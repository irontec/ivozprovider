<?php

namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

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

    /**
     * @return void
     */
    protected function addService(string $event, PickUpRelUserLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
