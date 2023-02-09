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
}
