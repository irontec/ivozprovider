<?php

namespace Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FaxesInOutLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\FaxesInOut\SendFaxFile::class => 10,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, FaxesInOutLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
