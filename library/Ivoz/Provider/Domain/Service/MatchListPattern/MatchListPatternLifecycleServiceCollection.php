<?php

namespace Ivoz\Provider\Domain\Service\MatchListPattern;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class MatchListPatternLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(MatchListPatternLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}