<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;

/**
* ConditionalRoutesConditionsRelScheduleInterface
*/
interface ConditionalRoutesConditionsRelScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): static;

    public function getCondition(): ?ConditionalRoutesConditionInterface;

    public function getSchedule(): ScheduleInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
