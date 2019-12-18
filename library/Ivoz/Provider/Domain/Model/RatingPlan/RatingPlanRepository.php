<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface RatingPlanRepository extends ObjectRepository, Selectable
{

}
