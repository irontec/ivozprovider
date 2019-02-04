<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * HolidayDate
 */
class HolidayDate extends HolidayDateAbstract implements HolidayDateInterface
{
    use HolidayDateTrait;
    use RoutableTrait;

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

    protected function sanitizeValues()
    {
        if (!$this->getWholeDayEvent()) {
            $timeIn = $this->getTimeIn();
            $timeOut = $this->getTimeOut();

            if ($timeOut < $timeIn) {
                throw new \DomainException('Time out must be later than time in.');
            }
        } else {
            $this->setTimeIn(null);
            $this->setTimeOut(null);
        }

        $this->sanitizeRouteValues();
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        if (!$this->getNumberCountry()) {
            return "";
        }

        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }

    /**
     * Check if the given time matches this HolidayDate events
     *
     * @param \DateTime $time
     * @return bool
     */
    public function checkEventOnTime(\DateTime $time)
    {
        if ($this->getWholeDayEvent()) {
            return true;
        }

        // Check if time is between in and out
        $timezone = $time->getTimezone();

        $eventDateStr = $this->getEventDate()->format('Y-m-d');
        $timeInStr = $this->getTimeIn()->format('H:i:s');
        $timeIn = new \DateTime(
            "$eventDateStr $timeInStr",
            $timezone
        );

        $timeOutStr = $this->getTimeOut()->format('H:i:s');
        $timeOut = new \DateTime(
            "$eventDateStr $timeOutStr",
            $timezone
        );

        $eventOnTime = ($time >= $timeIn && $time <= $timeOut);

        return $eventOnTime;
    }
}
