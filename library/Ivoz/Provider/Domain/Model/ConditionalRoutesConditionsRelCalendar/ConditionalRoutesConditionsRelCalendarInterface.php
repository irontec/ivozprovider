<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;

/**
* ConditionalRoutesConditionsRelCalendarInterface
*/
interface ConditionalRoutesConditionsRelCalendarInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): static;

    public function getCondition(): ?ConditionalRoutesConditionInterface;

    public function getCalendar(): CalendarInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
