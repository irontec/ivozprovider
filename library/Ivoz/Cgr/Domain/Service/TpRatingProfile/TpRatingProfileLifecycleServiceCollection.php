<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpRatingProfileLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, TpRatingProfileLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
