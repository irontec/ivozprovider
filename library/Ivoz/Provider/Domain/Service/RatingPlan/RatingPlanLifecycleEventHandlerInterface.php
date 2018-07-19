<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\LifecycleEventHandlerInterface;

interface RatingPlanLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(RatingPlanInterface $entity);
}