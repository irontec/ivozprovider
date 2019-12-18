<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

interface RatingPlanLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RatingPlanInterface $ratingPlan);
}
