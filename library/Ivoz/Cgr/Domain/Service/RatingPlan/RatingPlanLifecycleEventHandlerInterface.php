<?php

namespace Ivoz\Cgr\Domain\Service\RatingPlan;

use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface;

interface RatingPlanLifecycleEventHandlerInterface
{
    public function execute(RatingPlanInterface $entity);
}