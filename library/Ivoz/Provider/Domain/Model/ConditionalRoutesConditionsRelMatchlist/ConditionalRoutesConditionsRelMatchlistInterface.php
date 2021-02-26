<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;

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

    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): static;

    public function getCondition(): ?ConditionalRoutesConditionInterface;

    public function getMatchlist(): MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
