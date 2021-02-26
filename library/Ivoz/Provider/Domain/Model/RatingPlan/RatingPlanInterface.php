<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;

/**
* RatingPlanInterface
*/
interface RatingPlanInterface extends LoggableEntityInterface
{
    const TIMINGTYPE_ALWAYS = 'always';

    const TIMINGTYPE_CUSTOM = 'custom';

    public function getChangeSet();

    /**
     * Transform Weekdays booleans to a string for TpTimings
     *
     * @return string
     */
    public function getWeekDays();

    /**
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag();

    /**
     * CGrates tag for Timing associated to this Rating Plan
     *
     * @return string
     */
    public function getCgrTimingTag();

    public function getWeight(): float;

    public function getTimingType(): ?string;

    public function getTimeIn(): \DateTime;

    public function getMonday(): ?bool;

    public function getTuesday(): ?bool;

    public function getWednesday(): ?bool;

    public function getThursday(): ?bool;

    public function getFriday(): ?bool;

    public function getSaturday(): ?bool;

    public function getSunday(): ?bool;

    public function setRatingPlanGroup(RatingPlanGroupInterface $ratingPlanGroup): static;

    public function getRatingPlanGroup(): RatingPlanGroupInterface;

    public function getDestinationRateGroup(): DestinationRateGroupInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function setTpTiming(TpTimingInterface $tpTiming): static;

    public function getTpTiming(): ?TpTimingInterface;

    public function setTpRatingPlan(TpRatingPlanInterface $tpRatingPlan): static;

    public function getTpRatingPlan(): ?TpRatingPlanInterface;

}
