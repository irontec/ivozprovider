<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpRatingPlanLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpRatingPlanInterface $entity);
}