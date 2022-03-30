<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface RatingPlanRepository extends ObjectRepository, Selectable
{
}
