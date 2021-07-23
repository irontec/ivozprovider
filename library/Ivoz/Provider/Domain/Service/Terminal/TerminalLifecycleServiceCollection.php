<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Domain\Assert\Assertion;
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
            \Ivoz\Ast\Domain\Service\PsIdentify\UpdateByTerminal::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, TerminalLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
