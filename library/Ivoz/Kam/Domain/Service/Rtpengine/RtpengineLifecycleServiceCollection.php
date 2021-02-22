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

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Kam\Domain\Service\Rtpengine\SendTrunksRtpengineReloadRequest::class => 200,
            \Ivoz\Kam\Domain\Service\Rtpengine\SendUsersRtpengineReloadRequest::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, RtpengineLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
