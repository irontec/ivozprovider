<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ConditionalRoutesConditionsRelMatchlistInterface
*/
interface ConditionalRoutesConditionsRelMatchlistInterface extends LoggableEntityInterface
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
    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): ConditionalRoutesConditionsRelMatchlistInterface;

    /**
     * Get condition
     *
     * @return ConditionalRoutesConditionInterface | null
     */
    public function getCondition(): ?ConditionalRoutesConditionInterface;

    /**
     * Get matchlist
     *
     * @return MatchListInterface
     */
    public function getMatchlist(): MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
