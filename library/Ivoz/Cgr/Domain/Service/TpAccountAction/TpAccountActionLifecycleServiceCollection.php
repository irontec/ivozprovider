<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpAccountActionLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(TpAccountActionLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
