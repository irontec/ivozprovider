<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLock;

/**
* ConditionalRoutesConditionsRelRouteLockAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionsRelRouteLockAbstract
{
    use ChangelogTrait;

    /**
     * @var ConditionalRoutesConditionInterface
     * inversedBy relRouteLocks
     */
    protected $condition;

    /**
     * @var RouteLockInterface
     */
    protected $routeLock;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

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
     * @param ConditionalRoutesConditionsRelRouteLockInterface|null $entity
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

        /** @var ConditionalRoutesConditionsRelRouteLockDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelRouteLockDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelRouteLockDto::class);

        $self = new static(

        );

        $self
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setRouteLock($fkTransformer->transform($dto->getRouteLock()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelRouteLockDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelRouteLockDto::class);

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setRouteLock($fkTransformer->transform($dto->getRouteLock()));

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
            ->setCondition(ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setRouteLock(RouteLock::entityToDto(self::getRouteLock(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'conditionId' => self::getCondition() ? self::getCondition()->getId() : null,
            'routeLockId' => self::getRouteLock()->getId()
        ];
    }

    /**
     * Set condition
     *
     * @param ConditionalRoutesConditionInterface | null
     *
     * @return static
     */
    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): ConditionalRoutesConditionsRelRouteLockInterface
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return ConditionalRoutesConditionInterface | null
     */
    public function getCondition(): ?ConditionalRoutesConditionInterface
    {
        return $this->condition;
    }

    /**
     * Set routeLock
     *
     * @param RouteLockInterface
     *
     * @return static
     */
    protected function setRouteLock(RouteLockInterface $routeLock): ConditionalRoutesConditionsRelRouteLockInterface
    {
        $this->routeLock = $routeLock;

        return $this;
    }

    /**
     * Get routeLock
     *
     * @return RouteLockInterface
     */
    public function getRouteLock(): RouteLockInterface
    {
        return $this->routeLock;
    }

}
