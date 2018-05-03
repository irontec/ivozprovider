<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;

interface TpDestinationLifecycleEventHandlerInterface
{
    public function execute(TpDestinationInterface $entity);
}