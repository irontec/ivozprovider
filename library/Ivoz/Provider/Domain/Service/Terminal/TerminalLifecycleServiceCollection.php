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

    /**
     * @return void
     */
    protected function addService(TerminalLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
