<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TpRatingPlanRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $tag
     * @return RatingPlanInterface
     */
    public function findOneByTag(string $tag);
}
