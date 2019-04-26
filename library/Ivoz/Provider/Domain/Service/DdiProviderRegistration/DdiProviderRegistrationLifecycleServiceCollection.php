<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderRegistration;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiProviderRegistrationLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, DdiProviderRegistrationLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
