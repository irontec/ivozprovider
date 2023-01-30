<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* OutgoingDdiRuleInterface
*/
interface OutgoingDdiRuleInterface extends LoggableEntityInterface
{
    public const DEFAULTACTION_KEEP = 'keep';

    public const DEFAULTACTION_FORCE = 'force';

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
     * Return forced Ddi for this rule
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getForcedDdi(): ?DdiInterface;

    /**
     * Check final outgoing Ddi presentation for given destination
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $originalDdi
     * @param string $e164destination
     * @param string $prefix
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null $e164destination
     */
    public function getOutgoingDdi($originalDdi, $e164destination, $prefix = '');

    public static function createDto(string|int|null $id = null): OutgoingDdiRuleDto;

    /**
     * @internal use EntityTools instead
     * @param null|OutgoingDdiRuleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?OutgoingDdiRuleDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingDdiRuleDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): OutgoingDdiRuleDto;

    public function getName(): string;

    public function getDefaultAction(): string;

    public function getCompany(): CompanyInterface;

    public function addPattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface;

    public function removePattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface;

    /**
     * @param Collection<array-key, OutgoingDdiRulesPatternInterface> $patterns
     */
    public function replacePatterns(Collection $patterns): OutgoingDdiRuleInterface;

    /**
     * @return array<array-key, OutgoingDdiRulesPatternInterface>
     */
    public function getPatterns(?Criteria $criteria = null): array;
}
