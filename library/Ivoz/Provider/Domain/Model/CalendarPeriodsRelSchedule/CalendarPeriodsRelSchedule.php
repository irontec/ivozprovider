<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

/**
 * CalendarPeriodsRelSchedule
 */
class CalendarPeriodsRelSchedule extends CalendarPeriodsRelScheduleAbstract implements CalendarPeriodsRelScheduleInterface
{
    use CalendarPeriodsRelScheduleTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
