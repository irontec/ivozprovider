<?php

namespace Ivoz\Kam\Domain\Service\Rtpproxy;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RtpproxyLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(RtpproxyLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}