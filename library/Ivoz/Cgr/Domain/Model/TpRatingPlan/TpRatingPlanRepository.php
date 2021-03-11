<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TpRatingPlanRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $tag
     * @return \Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface | null
     */
    public function findOneByTag(string $tag);
}
