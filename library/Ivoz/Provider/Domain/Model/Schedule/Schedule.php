<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

/**
 * Schedule
 */
class Schedule extends ScheduleAbstract implements ScheduleInterface
{
    use ScheduleTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
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

    public function checkIsOnTimeRange($dayOfTheWeek, \DateTime $time, \DateTimeZone $timeZone)
    {
        if (!call_user_func(array($this, 'get' . $dayOfTheWeek))) {
            return false;
        }

        $time = strtotime(
            $time
                ->setTimezone($timeZone)
                ->format('H:i:s')
        );

        $timeIn = strtotime(
            $this->getTimeIn()
                ->format('H:i:s')
        );

        $timeOut = strtotime(
            $this->getTimeout()
                ->format('H:i:s')
        );

        $isInTimeRange =
            ($time > $timeIn)
            && ($time < $timeOut);

        return $isInTimeRange;
    }

    public function isOnSchedule(\DateTime $time)
    {
        // Check if Day of The Week is enabled in the schedule
        $dayOfTheWeek = $time->format("l");
        if (!call_user_func(array($this, "get" . $dayOfTheWeek))) {
            return false;
        }

        // Check if time is between begining and end
        $timezone = $time->getTimezone();
        $timeIn = new \DateTime(
            $this->getTimeIn(),
            $timezone
        );
        $timeOut = new \DateTime(
            $this->getTimeOut(),
            $timezone
        );
        $isOnSchedule = ($time >= $timeIn && $time < $timeOut);

        return $isOnSchedule;
    }
}
