<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;

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

    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): static;

    public function getCondition(): ?ConditionalRoutesConditionInterface;

    public function getRouteLock(): RouteLockInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
