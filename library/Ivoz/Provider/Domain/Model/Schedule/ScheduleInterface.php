<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use DateTimeInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* ScheduleInterface
*/
interface ScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Check if current time is inside Schedule
     *
     * @param \DateTime $time Current time in Client's Timezone
     * @return bool
     */
    public function isOnSchedule(DateTimeInterface $time);

    public function getName(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getTimeIn(): \DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getTimeout(): \DateTimeInterface;

    public function getMonday(): ?bool;

    public function getTuesday(): ?bool;

    public function getWednesday(): ?bool;

    public function getThursday(): ?bool;

    public function getFriday(): ?bool;

    public function getSaturday(): ?bool;

    public function getSunday(): ?bool;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
