<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;

class InheritDestinationRateTag implements TpDestinationRateLifecycleEventHandlerInterface
{
    public function execute(TpDestinationRateInterface $entity)
    {
        /** Get CGRates tag from parent table */
        $entity->setTag(
            $entity->getDestinationRate()->getTag()
        );

        $entity->setDestinationsTag(
            $entity->getDestination()->getTag()
        );

        $entity->setRatesTag(
            $entity->getRate()->getTag()
        );

    }

}
