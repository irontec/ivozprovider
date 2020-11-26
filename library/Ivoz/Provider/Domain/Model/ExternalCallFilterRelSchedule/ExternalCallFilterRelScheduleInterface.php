<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ExternalCallFilterRelScheduleInterface
*/
interface ExternalCallFilterRelScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set filter
     *
     * @param ExternalCallFilterInterface | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterInterface $filter = null): ExternalCallFilterRelScheduleInterface;

    /**
     * Get filter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getFilter(): ?ExternalCallFilterInterface;

    /**
     * Get schedule
     *
     * @return ScheduleInterface
     */
    public function getSchedule(): ScheduleInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
