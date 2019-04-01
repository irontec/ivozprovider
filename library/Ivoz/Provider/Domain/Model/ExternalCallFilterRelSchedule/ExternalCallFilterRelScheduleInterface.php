<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter
     *
     * @return static
     */
    public function setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $filter = null);

    /**
     * Get filter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface
     */
    public function getFilter();

    /**
     * Set schedule
     *
     * @param \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface $schedule
     *
     * @return static
     */
    public function setSchedule(\Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface $schedule);

    /**
     * Get schedule
     *
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface
     */
    public function getSchedule();
}
