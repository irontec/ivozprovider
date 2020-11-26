<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * comment: enum:callerin|calleein|callerout|calleeout
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var int | null
     */
    protected $priority;

    /**
     * @var string | null
     */
    protected $matchExpr;

    /**
     * @var string | null
     */
    protected $replaceExpr;

    /**
     * @var TransformationRuleSetInterface
     * inversedBy rules
     */
    protected $transformationRuleSet;

    /**
     * Constructor
     */
    protected function __construct(
        $type,
        $description
    ) {
        $this->setType($type);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TransformationRule",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return TransformationRuleDto
     */
    public static function createDto($id = null)
    {
        return new TransformationRuleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TransformationRuleInterface|null $entity
     * @param int $depth
     * @return TransformationRuleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var TransformationRuleDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TransformationRuleDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TransformationRuleDto::class);

        $self = new static(
            $dto->getType(),
            $dto->getDescription()
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TransformationRuleDto::class);

        $this
            ->setType($dto->getType())
            ->setDescription($dto->getDescription())
            ->setPriority($dto->getPriority())
            ->setMatchExpr($dto->getMatchExpr())
            ->setReplaceExpr($dto->getReplaceExpr())
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TransformationRuleDto
     */
    public function toDto($depth = 0)
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
     * @return array
     */
    protected function __toArray()
    {
        return [
            'type' => self::getType(),
            'description' => self::getDescription(),
            'priority' => self::getPriority(),
            'matchExpr' => self::getMatchExpr(),
            'replaceExpr' => self::getReplaceExpr(),
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null
        ];
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return static
     */
    protected function setType(string $type): TransformationRuleInterface
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

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return static
     */
    protected function setDescription(string $description): TransformationRuleInterface
    {
        Assertion::maxLength($description, 64, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set priority
     *
     * @param int $priority | null
     *
     * @return static
     */
    protected function setPriority(?int $priority = null): TransformationRuleInterface
    {
        if (!is_null($priority)) {
            Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');
        }

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * Set matchExpr
     *
     * @param string $matchExpr | null
     *
     * @return static
     */
    protected function setMatchExpr(?string $matchExpr = null): TransformationRuleInterface
    {
        if (!is_null($matchExpr)) {
            Assertion::maxLength($matchExpr, 128, 'matchExpr value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->matchExpr = $matchExpr;

        return $this;
    }

    /**
     * Get matchExpr
     *
     * @return string | null
     */
    public function getMatchExpr(): ?string
    {
        return $this->matchExpr;
    }

    /**
     * Set replaceExpr
     *
     * @param string $replaceExpr | null
     *
     * @return static
     */
    protected function setReplaceExpr(?string $replaceExpr = null): TransformationRuleInterface
    {
        if (!is_null($replaceExpr)) {
            Assertion::maxLength($replaceExpr, 128, 'replaceExpr value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->replaceExpr = $replaceExpr;

        return $this;
    }

    /**
     * Get replaceExpr
     *
     * @return string | null
     */
    public function getReplaceExpr(): ?string
    {
        return $this->replaceExpr;
    }

    /**
     * Set transformationRuleSet
     *
     * @param TransformationRuleSetInterface | null
     *
     * @return static
     */
    public function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): TransformationRuleInterface
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

}
