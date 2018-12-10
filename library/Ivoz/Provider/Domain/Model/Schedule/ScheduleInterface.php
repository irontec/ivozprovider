<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function checkIsOnTimeRange($dayOfTheWeek, \DateTime $time, \DateTimeZone $timeZone);

    public function isOnSchedule(\DateTime $time);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get timeIn
     *
     * @return \DateTime
     */
    public function getTimeIn();

    /**
     * Get timeout
     *
     * @return \DateTime
     */
    public function getTimeout();

    /**
     * Get monday
     *
     * @return boolean
     */
    public function getMonday();

    /**
     * Get tuesday
     *
     * @return boolean
     */
    public function getTuesday();

    /**
     * Get wednesday
     *
     * @return boolean
     */
    public function getWednesday();

    /**
     * Get thursday
     *
     * @return boolean
     */
    public function getThursday();

    /**
     * Get friday
     *
     * @return boolean
     */
    public function getFriday();

    /**
     * Get saturday
     *
     * @return boolean
     */
    public function getSaturday();

    /**
     * Get sunday
     *
     * @return boolean
     */
    public function getSunday();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();
}
