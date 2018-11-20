<?php

namespace Ivoz\Provider\Domain\Service\RoutingTag;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;

interface RoutingTagLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RoutingTagInterface $entity);
}
