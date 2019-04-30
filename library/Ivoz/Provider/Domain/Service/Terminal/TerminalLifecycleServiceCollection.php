<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TerminalLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Terminal\CheckUniqueness::class => 200,
        ],
        "post_persist" =>
        [
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByTerminal::class => 10,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TerminalLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
