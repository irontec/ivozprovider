<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TrustedLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, TrustedLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
