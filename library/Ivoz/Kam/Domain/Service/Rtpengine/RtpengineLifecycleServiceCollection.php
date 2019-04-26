<?php

namespace Ivoz\Kam\Domain\Service\Rtpengine;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RtpengineLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, RtpengineLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
