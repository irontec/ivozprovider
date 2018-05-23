<?php

namespace Ivoz\Cgr\Domain\Service\DestinationRate;

use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface DestinationRateLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DestinationRateInterface $entity);
}