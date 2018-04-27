<?php

namespace Ivoz\Cgr\Domain\Service\RatingPlan;

use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface RatingPlanLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RatingPlanInterface $entity);
}