<?php

namespace Ivoz\Provider\Domain\Service\ConferenceRoom;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class ConferenceRoomLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(ConferenceRoomLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}