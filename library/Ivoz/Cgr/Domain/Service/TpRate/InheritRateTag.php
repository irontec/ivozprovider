<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;

class InheritRateTag implements TpRateLifecycleEventHandlerInterface
{
    public function execute(TpRateInterface $entity)
    {
        /** Get CGRates tag from parent table */
        $entity->setTag(
            $entity->getRate()->getTag()
        );
    }

}
