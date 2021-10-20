<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;

/**
* ExternalCallFilterRelScheduleInterface
*/
interface ExternalCallFilterRelScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function setFilter(?ExternalCallFilterInterface $filter = null): static;

    public function getFilter(): ?ExternalCallFilterInterface;

    public function getSchedule(): ScheduleInterface;

    public function isInitialized(): bool;
}
