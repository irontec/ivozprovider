<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use DateTime;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ScheduleInterface
*/
interface ScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if current time is inside Schedule
     *
     * @param \DateTime $time Current time in Client's Timezone
     * @return bool
     */
    public function isOnSchedule(DateTime $time);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get timeIn
     *
     * @return \DateTimeInterface
     */
    public function getTimeIn(): \DateTimeInterface;

    /**
     * Get timeout
     *
     * @return \DateTimeInterface
     */
    public function getTimeout(): \DateTimeInterface;

    /**
     * Get monday
     *
     * @return bool | null
     */
    public function getMonday(): ?bool;

    /**
     * Get tuesday
     *
     * @return bool | null
     */
    public function getTuesday(): ?bool;

    /**
     * Get wednesday
     *
     * @return bool | null
     */
    public function getWednesday(): ?bool;

    /**
     * Get thursday
     *
     * @return bool | null
     */
    public function getThursday(): ?bool;

    /**
     * Get friday
     *
     * @return bool | null
     */
    public function getFriday(): ?bool;

    /**
     * Get saturday
     *
     * @return bool | null
     */
    public function getSaturday(): ?bool;

    /**
     * Get sunday
     *
     * @return bool | null
     */
    public function getSunday(): ?bool;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
