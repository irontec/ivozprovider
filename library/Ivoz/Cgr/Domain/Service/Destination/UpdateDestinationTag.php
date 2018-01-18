<?php

namespace Ivoz\Cgr\Domain\Service\Destination;

use Ivoz\Cgr\Domain\Model\Destination\DestinationInterface;

class UpdateDestinationTag implements DestinationLifecycleEventHandlerInterface
{
    public function execute(DestinationInterface $entity)
    {
        /** Set CGRates Unique Tag */
        $entity->setTag(
            sprintf("b%ddst%d",
                $entity->getBrand()->getId(),
                $entity->getId()
            )
        );
    }

}
