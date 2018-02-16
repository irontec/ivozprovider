<?php

namespace Ivoz\Cgr\Domain\Service\Rate;

use Ivoz\Cgr\Domain\Model\Rate\RateInterface;

class UpdateRateTag implements RateLifecycleEventHandlerInterface
{
    public function execute(RateInterface $entity)
    {
        /** Set CGRates Unique Tag */
        $entity->setTag(
            sprintf("b%drt%d",
                $entity->getBrand()->getId(),
                $entity->getId()
            )
        );
    }

}
