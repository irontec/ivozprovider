<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TrunksUacregLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(TrunksUacregLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
