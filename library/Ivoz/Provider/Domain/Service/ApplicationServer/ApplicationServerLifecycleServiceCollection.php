<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ApplicationServerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, ApplicationServerLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
