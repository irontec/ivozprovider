<?php

namespace Ivoz\Provider\Domain\Service\PeeringContract;

use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;

interface PeeringContractLifecycleEventHandlerInterface
{
    public function execute(PeeringContractInterface $entity, $isNew);
}