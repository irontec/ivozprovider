<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;

class InheritDestinationRateTag implements TpDestinationRateLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(TpDestinationRateInterface $entity)
    {
        /** Get CGRates tag from parent table */
        $entity->setTag(
            $entity->getDestinationRate()->getTag()
        );

        $entity->setDestinationsTag(
            $entity->getDestinationRate()->getTag() . 'dst' . $entity->getId()
        );

        $entity->setRatesTag(
            $entity->getDestinationRate()->getTag() . 'rt' . $entity->getId()
        );
    }

}
