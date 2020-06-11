<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TransformationRuleAbstract
 * @codeCoverageIgnore
 */
abstract class TransformationRuleAbstract
{
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
     * @var integer | null
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
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($type, $description)
    {
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set type
     *
     * @param string $type
     *
     * @return static
     */
    protected function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 10, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, [
            TransformationRuleInterface::TYPE_CALLERIN,
            TransformationRuleInterface::TYPE_CALLEEIN,
            TransformationRuleInterface::TYPE_CALLEROUT,
            TransformationRuleInterface::TYPE_CALLEEOUT
        ], 'typevalue "%s" is not an element of the valid values: %s');

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
    protected function setDescription($description)
    {
        Assertion::notNull($description, 'description value "%s" is null, but non null value was expected.');
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
     * @param integer $priority | null
     *
     * @return static
     */
    protected function setPriority($priority = null)
    {
        if (!is_null($priority)) {
            Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($priority, 0, 'priority provided "%s" is not greater or equal than "%s".');
            $priority = (int) $priority;
        }

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer | null
     */
    public function getPriority()
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
    protected function setMatchExpr($matchExpr = null)
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
    public function getMatchExpr()
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
    protected function setReplaceExpr($replaceExpr = null)
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
    public function getReplaceExpr()
    {
        return $this->replaceExpr;
    }

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet | null
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    // @codeCoverageIgnoreEnd
}
