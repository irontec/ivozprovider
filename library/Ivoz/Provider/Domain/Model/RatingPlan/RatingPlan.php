<?php

namespace Ivoz\Provider\Domain\Model\RatingPlan;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;

/**
 * RatingPlan
 */
class RatingPlan extends RatingPlanAbstract implements RatingPlanInterface
{
    use RatingPlanTrait;

    const TIMING_TYPE_ALWAYS = self::TIMINGTYPE_ALWAYS;
    const TIMING_TYPE_CUSTOM = self::TIMINGTYPE_CUSTOM;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {
        if ($this->getTimingType() == RatingPlan::TIMING_TYPE_ALWAYS) {
            $this
                ->setMonday(true)
                ->setTuesday(true)
                ->setWednesday(true)
                ->setThursday(true)
                ->setFriday(true)
                ->setSaturday(true)
                ->setSunday(true)
                ->setTimeIn(new \DateTime('00:00:00'));
        }
    }

    /**
     * Transform Weekdays booleans to a string for TpTimings
     *
     * @return string
     */
    public function getWeekDays()
    {
        $daysMap = [
            1 => $this->getMonday(),
            2 => $this->getTuesday(),
            3 => $this->getWednesday(),
            4 => $this->getThursday(),
            5 => $this->getFriday(),
            6 => $this->getSaturday(),
            7 => $this->getSunday(),
        ];

        $weekDays = array_filter($daysMap, function ($v) {
            return $v !== 0;
        });

        if (count($weekDays) == 7) {
            return TpTiming::TIMING_ANY;
        }

        return implode(';', array_keys($weekDays));
    }

    /**
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag()
    {
        return $this
            ->getRatingPlanGroup()
            ->getCgrTag();
    }

    /**
     * CGrates tag for Timing associated to this Rating Plan
     *
     * @return string
     */
    public function getCgrTimingTag()
    {
        if ($this->getTimingType() == self::TIMING_TYPE_ALWAYS) {
            return TpTiming::TIMING_ANY;
        }

        return sprintf(
            "b%dtm%d",
            $this->getRatingPlanGroup()->getBrand()->getId(),
            $this->getId()
        );
    }
}
