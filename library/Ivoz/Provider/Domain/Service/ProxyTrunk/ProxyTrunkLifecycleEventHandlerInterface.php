<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunk;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;

interface ProxyTrunkLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ProxyTrunkInterface $entity);
}
