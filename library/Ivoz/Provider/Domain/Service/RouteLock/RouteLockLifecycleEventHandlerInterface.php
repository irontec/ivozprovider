<?php

namespace Ivoz\Provider\Domain\Service\RouteLock;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;

interface RouteLockLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RouteLockInterface $routeLock): void;
}
