<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class UserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Contact\UpdateByUser::class => 10,
            \Ivoz\Ast\Domain\Service\Voicemail\UpdateByUser::class => 10,
            \Ivoz\Provider\Domain\Service\Extension\UpdateByUser::class => 20,
            \Ivoz\Provider\Domain\Service\User\UnsetBossAssistant::class => 30,
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByUser::class => 40,
        ],
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Ivr\UpdateByUser::class => 10,
        ],
        "post_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Extension\UpdateByUser::class => 10,
        ],
        "error_handler" =>
        [
            \Ivoz\Provider\Domain\Service\User\PersistErrorHandler::class => 200,
        ],
    ];


    protected function addService(string $event, UserLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
