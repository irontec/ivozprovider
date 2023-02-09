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
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Check if current time is inside Schedule
     *
     * @param \DateTime $time Current time in Client's Timezone
     * @return bool
     */
    public function isOnSchedule(\DateTimeInterface $time)
    {
        // Check if Day of The Week is enabled in the schedule
        $dayOfTheWeek = $time->format("l");
        if (!call_user_func(array($this, "get" . $dayOfTheWeek))) {
            return false;
        }

        // Check if time is between begining and end
        $timezone = $time->getTimezone();

        // Create new TimeIn/TimeOut with db times and client's timezone
        $timeIn = new \DateTime(
            $this->getTimeIn()->format('H:i:s'),
            $timezone
        );
        $timeOut = new \DateTime(
            $this->getTimeOut()->format('H:i:s'),
            $timezone
        );

        $isOnSchedule = ($time >= $timeIn && $time < $timeOut);

        return $isOnSchedule;
    }
}
