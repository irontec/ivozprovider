<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition
     *
     * @return self
     */
    public function setCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition = null);

    /**
     * Get condition
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface
     */
    public function getCondition();

    /**
     * Set routeLock
     *
     * @param \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface $routeLock
     *
     * @return self
     */
    public function setRouteLock(\Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface $routeLock);

    /**
     * Get routeLock
     *
     * @return \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface
     */
    public function getRouteLock();
}
