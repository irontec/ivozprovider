<?php

namespace Ivoz\Provider\Domain\Service\QueueMember;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class QueueMemberLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(QueueMemberLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}