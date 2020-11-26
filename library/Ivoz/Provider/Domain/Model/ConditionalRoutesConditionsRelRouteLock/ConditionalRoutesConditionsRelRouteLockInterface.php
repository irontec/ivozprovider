<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ConditionalRoutesConditionsRelRouteLockInterface
*/
interface ConditionalRoutesConditionsRelRouteLockInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set condition
     *
     * @param ConditionalRoutesConditionInterface | null
     *
     * @return static
     */
    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): ConditionalRoutesConditionsRelRouteLockInterface;

    /**
     * Get condition
     *
     * @return ConditionalRoutesConditionInterface | null
     */
    public function getCondition(): ?ConditionalRoutesConditionInterface;

    /**
     * Get routeLock
     *
     * @return RouteLockInterface
     */
    public function getRouteLock(): RouteLockInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
