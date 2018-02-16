<?php

namespace Ivoz\Cgr\Domain\Service\DestinationRate;

use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface;

class UpdateDestinationRateTag implements DestinationRateLifecycleEventHandlerInterface
{
    public function execute(DestinationRateInterface $entity)
    {
        /** Set CGRates Unique Tag */
        $entity->setTag(
            sprintf("b%ddr%d",
                $entity->getBrand()->getId(),
                $entity->getId()
            )
        );
    }

}
