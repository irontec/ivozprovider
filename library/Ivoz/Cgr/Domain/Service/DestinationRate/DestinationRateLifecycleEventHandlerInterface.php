<?php

namespace Ivoz\Cgr\Domain\Service\DestinationRate;

use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface;

interface DestinationRateLifecycleEventHandlerInterface
{
    public function execute(DestinationRateInterface $entity);
}