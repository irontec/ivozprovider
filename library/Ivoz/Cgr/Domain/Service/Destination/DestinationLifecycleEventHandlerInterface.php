<?php

namespace Ivoz\Cgr\Domain\Service\Destination;

use Ivoz\Cgr\Domain\Model\Destination\DestinationInterface;

interface DestinationLifecycleEventHandlerInterface
{
    public function execute(DestinationInterface $entity);
}