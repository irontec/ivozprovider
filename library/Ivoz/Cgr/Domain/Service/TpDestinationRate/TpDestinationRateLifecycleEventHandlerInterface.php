<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;

interface TpDestinationRateLifecycleEventHandlerInterface
{
    public function execute(TpDestinationRateInterface $entity);
}