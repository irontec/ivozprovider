<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;

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

    public function setFilter(?ExternalCallFilterInterface $filter = null): static;

    public function getFilter(): ?ExternalCallFilterInterface;

    public function getCalendar(): CalendarInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
