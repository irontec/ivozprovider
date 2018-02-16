<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;

class InheritDestinationTag implements TpDestinationLifecycleEventHandlerInterface
{
    public function execute(TpDestinationInterface $entity)
    {
        /** Get CGRates tag from parent table */
        $entity->setTag(
            $entity->getDestination()->getTag()
        );
    }

}
