<?php

namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TerminalModelLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\TerminalModel\PersistTemplates::class => 10,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TerminalModelLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
