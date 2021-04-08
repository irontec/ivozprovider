<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;

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

    public function getType(): string;

    public function getPrefix(): ?string;

    public function getAction(): string;

    public function getPriority(): int;

    public function setOutgoingDdiRule(OutgoingDdiRuleInterface $outgoingDdiRule): static;

    public function getOutgoingDdiRule(): OutgoingDdiRuleInterface;

    public function getMatchList(): ?MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
