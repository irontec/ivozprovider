<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;

/**
 * TpRatingPlan
 */
class TpRatingPlan extends TpRatingPlanAbstract implements TpRatingPlanInterface
{
    use TpRatingPlanTrait;

    const TIMING_TYPE_ALWAYS = 'always';
    const TIMING_TYPE_CUSTOM = 'custom';

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
        if ($this->getTimingType() == TpRatingPlan::TIMING_TYPE_ALWAYS) {
            $this
                ->setTimingTag(TpTiming::TIMING_ANY)
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
}
