<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

/**
* TransformationRuleInterface
*/
interface TransformationRuleInterface extends LoggableEntityInterface
{
    public const TYPE_CALLERIN = 'callerin';

    public const TYPE_CALLEEIN = 'calleein';

    public const TYPE_CALLEROUT = 'callerout';

    public const TYPE_CALLEEOUT = 'calleeout';

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
     * {@inheritDoc}
     */
    public function setMatchExpr(?string $matchExpr = null): static;

    public static function createDto(string|int|null $id = null): TransformationRuleDto;

    /**
     * @internal use EntityTools instead
     * @param null|TransformationRuleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TransformationRuleDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TransformationRuleDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TransformationRuleDto;

    public function getType(): string;

    public function getDescription(): string;

    public function getPriority(): ?int;

    public function getMatchExpr(): ?string;

    public function getReplaceExpr(): ?string;

    public function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): static;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;
}
