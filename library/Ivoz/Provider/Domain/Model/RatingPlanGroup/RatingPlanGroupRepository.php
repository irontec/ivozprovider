<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RatingPlanGroupRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $ratingPlanGroupId
     * @return \Generator
     */
    public function getAllRatesByRatingPlanId($ratingPlanGroupId, $batchSize = 10000, callable $queryModifier = null);
}
