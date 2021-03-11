<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface RatingPlanGroupRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $ratingPlanGroupId
     * @return \Generator
     */
    public function getAllRatesByRatingPlanId($ratingPlanGroupId, $batchSize = 10000, callable $queryModifier = null);
}
