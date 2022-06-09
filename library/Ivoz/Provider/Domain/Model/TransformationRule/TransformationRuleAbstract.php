<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;

/**
* TransformationRuleAbstract
* @codeCoverageIgnore
*/
abstract class TransformationRuleAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * comment: enum:callerin|calleein|callerout|calleeout
     */
    protected $type;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var ?int
     */
    protected $priority = null;

    /**
     * @var ?string
     */
    protected $matchExpr = null;

    /**
     * @var ?string
     */
    protected $replaceExpr = null;

    /**
     * @var ?TransformationRuleSetInterface
     * inversedBy rules
     */
    protected $transformationRuleSet = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $type,
        string $description
    ) {
        $this->setType($type);
        $this->setDescription($description);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TransformationRule",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TransformationRuleDto
    {
        return new TransformationRuleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TransformationRuleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TransformationRuleDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TransformationRuleInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TransformationRuleDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TransformationRuleDto::class);
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');

        $self = new static(
            $type,
            $description
        );

        $self
            ->setPriority($dto->getPriority())
            ->setMatchExpr($dto->getMatchExpr())
            ->setReplaceExpr($dto->getReplaceExpr())
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TransformationRuleDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TransformationRuleDto::class);

        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');

        $this
            ->setType($type)
            ->setDescription($description)
            ->setPriority($dto->getPriority())
            ->setMatchExpr($dto->getMatchExpr())
            ->setReplaceExpr($dto->getReplaceExpr())
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TransformationRuleDto
    {
        return self::createDto()
            ->setType(self::getType())
            ->setDescription(self::getDescription())
            ->setPriority(self::getPriority())
            ->setMatchExpr(self::getMatchExpr())
            ->setReplaceExpr(self::getReplaceExpr())
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'type' => self::getType(),
            'description' => self::getDescription(),
            'priority' => self::getPriority(),
            'matchExpr' => self::getMatchExpr(),
            'replaceExpr' => self::getReplaceExpr(),
            'transformationRuleSetId' => self::getTransformationRuleSet()?->getId()
        ];
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 10, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                TransformationRuleInterface::TYPE_CALLERIN,
                TransformationRuleInterface::TYPE_CALLEEIN,
                TransformationRuleInterface::TYPE_CALLEROUT,
                TransformationRuleInterface::TYPE_CALLEEOUT,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setDescription(string $description): static
    {
        Assertion::maxLength($description, 64, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function setPriority(?int $priority = null): static
    {
        if (!is_null($priority)) {
            Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');
        }

        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    protected function setMatchExpr(?string $matchExpr = null): static
    {
        if (!is_null($matchExpr)) {
            Assertion::maxLength($matchExpr, 128, 'matchExpr value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->matchExpr = $matchExpr;

        return $this;
    }

    public function getMatchExpr(): ?string
    {
        return $this->matchExpr;
    }

    protected function setReplaceExpr(?string $replaceExpr = null): static
    {
        if (!is_null($replaceExpr)) {
            Assertion::maxLength($replaceExpr, 128, 'replaceExpr value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->replaceExpr = $replaceExpr;

        return $this;
    }

    public function getReplaceExpr(): ?string
    {
        return $this->replaceExpr;
    }

    public function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }
}
