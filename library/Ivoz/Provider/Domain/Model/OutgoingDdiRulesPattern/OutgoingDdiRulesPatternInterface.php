<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getForcedDdi();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix();

    /**
     * Get action
     *
     * @return string
     */
    public function getAction();

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule
     *
     * @return static
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null);

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    public function getOutgoingDdiRule();

    /**
     * Set matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList | null
     *
     * @return static
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList = null);

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface | null
     */
    public function getMatchList();

    /**
     * Set forcedDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi | null
     *
     * @return static
     */
    public function setForcedDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi = null);
}
