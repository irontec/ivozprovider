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
    public const TYPE_PREFIX = 'prefix';

    public const TYPE_DESTINATION = 'destination';

    public const ACTION_KEEP = 'keep';

    public const ACTION_FORCE = 'force';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Return forced Ddi for this rule pattern
     *
     * @return DdiInterface|null
     */
    public function getForcedDdi(): ?DdiInterface;

    public function getType(): string;

    public function getPrefix(): ?string;

    public function getAction(): string;

    public function getPriority(): int;

    public function setOutgoingDdiRule(OutgoingDdiRuleInterface $outgoingDdiRule): static;

    public function getOutgoingDdiRule(): OutgoingDdiRuleInterface;

    public function getMatchList(): ?MatchListInterface;

    public function isInitialized(): bool;
}
