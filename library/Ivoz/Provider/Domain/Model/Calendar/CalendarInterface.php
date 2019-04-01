<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @return static
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
     * @return static
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
     * @param ArrayCollection $holidayDates of Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface
     * @return static
     */
    public function replaceHolidayDates(ArrayCollection $holidayDates);

    /**
     * Get holidayDates
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface[]
     */
    public function getHolidayDates(\Doctrine\Common\Collections\Criteria $criteria = null);
}
