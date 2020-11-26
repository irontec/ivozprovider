<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ExternalCallFilterRelCalendarInterface
*/
interface ExternalCallFilterRelCalendarInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get calendar
     *
     * @return CalendarInterface
     */
    public function getCalendar(): CalendarInterface;

    /**
     * Set filter
     *
     * @param ExternalCallFilterInterface | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterInterface $filter = null): ExternalCallFilterRelCalendarInterface;

    /**
     * Get filter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getFilter(): ?ExternalCallFilterInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
