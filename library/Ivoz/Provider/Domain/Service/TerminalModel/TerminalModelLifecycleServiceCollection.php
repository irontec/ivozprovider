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

    /**
     * @return void
     */
    protected function addService(TerminalModelLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
