<?php

namespace Ivoz\Provider\Domain\Service\Queue;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class QueueLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Ast\Domain\Service\Queue\UpdateByIvozQueue::class => 10,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, QueueLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
