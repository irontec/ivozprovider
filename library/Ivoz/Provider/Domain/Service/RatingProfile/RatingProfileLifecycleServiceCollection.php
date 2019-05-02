<?php

namespace Ivoz\Provider\Domain\Service\RatingProfile;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RatingProfileLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(RatingProfileLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
