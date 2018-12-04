<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * ConditionalRoutesConditionsRelRouteLockAbstract
 * @codeCoverageIgnore
 */
abstract class ConditionalRoutesConditionsRelRouteLockAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface
     */
    protected $condition;

    /**
     * @var \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface
     */
    protected $routeLock;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoutesConditionsRelRouteLock",
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
     * @return ConditionalRoutesConditionsRelRouteLockDto
     */
    public static function createDto($id = null)
    {
        return new ConditionalRoutesConditionsRelRouteLockDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return ConditionalRoutesConditionsRelRouteLockDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ConditionalRoutesConditionsRelRouteLockInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ConditionalRoutesConditionsRelRouteLockDto
         */
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelRouteLockDto::class);

        $self = new static();

        $self
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setRouteLock($fkTransformer->transform($dto->getRouteLock()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ConditionalRoutesConditionsRelRouteLockDto
         */
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelRouteLockDto::class);

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setRouteLock($fkTransformer->transform($dto->getRouteLock()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConditionalRoutesConditionsRelRouteLockDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setRouteLock(\Ivoz\Provider\Domain\Model\RouteLock\RouteLock::entityToDto(self::getRouteLock(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'conditionId' => self::getCondition() ? self::getCondition()->getId() : null,
            'routeLockId' => self::getRouteLock() ? self::getRouteLock()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set condition
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition
     *
     * @return self
     */
    public function setCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition = null)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Set routeLock
     *
     * @param \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface $routeLock
     *
     * @return self
     */
    public function setRouteLock(\Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface $routeLock)
    {
        $this->routeLock = $routeLock;

        return $this;
    }

    /**
     * Get routeLock
     *
     * @return \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface
     */
    public function getRouteLock()
    {
        return $this->routeLock;
    }

    // @codeCoverageIgnoreEnd
}
