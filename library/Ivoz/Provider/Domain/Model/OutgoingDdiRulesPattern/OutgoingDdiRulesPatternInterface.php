<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* OutgoingDdiRulesPatternInterface
*/
interface OutgoingDdiRulesPatternInterface extends LoggableEntityInterface
{
    const TYPE_PREFIX = 'prefix';

    const TYPE_DESTINATION = 'destination';

    const ACTION_KEEP = 'keep';

    const ACTION_FORCE = 'force';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Return forced Ddi for this rule pattern
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getForcedDdi(): DdiInterface;

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix(): ?string;

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): string;

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * Set outgoingDdiRule
     *
     * @param OutgoingDdiRuleInterface
     *
     * @return static
     */
    public function setOutgoingDdiRule(OutgoingDdiRuleInterface $outgoingDdiRule): OutgoingDdiRulesPatternInterface;

    /**
     * Get outgoingDdiRule
     *
     * @return OutgoingDdiRuleInterface
     */
    public function getOutgoingDdiRule(): OutgoingDdiRuleInterface;

    /**
     * Get matchList
     *
     * @return MatchListInterface | null
     */
    public function getMatchList(): ?MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
