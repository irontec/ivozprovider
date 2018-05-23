<?php

namespace Ivoz\Provider\Domain\Service\PeeringContract;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;

interface PeeringContractLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(PeeringContractInterface $entity, $isNew);
}