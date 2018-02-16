<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;

interface TpRatingPlanLifecycleEventHandlerInterface
{
    public function execute(TpRatingPlanInterface $entity);
}