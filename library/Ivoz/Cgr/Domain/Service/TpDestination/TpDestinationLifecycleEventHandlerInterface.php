<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpDestinationLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpDestinationInterface $tpDestination);
}
