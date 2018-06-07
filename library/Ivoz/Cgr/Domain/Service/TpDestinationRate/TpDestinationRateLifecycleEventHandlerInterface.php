<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpDestinationRateLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpDestinationRateInterface $entity);
}