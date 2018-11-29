<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface CalendarInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if the given day is registered as Holiday
     *
     * @param \DateTime $date
     * @return bool
     */
    public function isHolidayDate($date);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

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

    /**
     * Add holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     *
     * @return CalendarTrait
     */
    public function addHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate);

    /**
     * Remove holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     */
    public function removeHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate);

    /**
     * Replace holidayDates
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface[] $holidayDates
     * @return self
     */
    public function replaceHolidayDates(Collection $holidayDates);

    /**
     * Get holidayDates
     *
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface[]
     */
    public function getHolidayDates(\Doctrine\Common\Collections\Criteria $criteria = null);
}
