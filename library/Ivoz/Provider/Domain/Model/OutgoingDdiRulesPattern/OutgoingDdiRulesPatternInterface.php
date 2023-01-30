<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * Return forced Ddi for this rule pattern
     *
     * @return DdiInterface|null
     */
    public function getForcedDdi(): ?DdiInterface;

    public static function createDto(string|int|null $id = null): OutgoingDdiRulesPatternDto;

    /**
     * @internal use EntityTools instead
     * @param null|OutgoingDdiRulesPatternInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?OutgoingDdiRulesPatternDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingDdiRulesPatternDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): OutgoingDdiRulesPatternDto;

    public function getType(): string;

    public function getPrefix(): ?string;

    public function getAction(): string;

    public function getPriority(): int;

    public function setOutgoingDdiRule(OutgoingDdiRuleInterface $outgoingDdiRule): static;

    public function getOutgoingDdiRule(): OutgoingDdiRuleInterface;

    public function getMatchList(): ?MatchListInterface;
}
