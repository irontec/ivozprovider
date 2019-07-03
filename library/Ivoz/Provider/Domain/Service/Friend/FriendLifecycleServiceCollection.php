<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FriendLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Friend\CheckUniqueness::class => 200,
        ],
        "post_persist" =>
        [
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByFriend::class => 10,
        ],
        "error_handler" =>
        [
            \Ivoz\Provider\Domain\Service\Friend\PersistErrorHandler::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, FriendLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
