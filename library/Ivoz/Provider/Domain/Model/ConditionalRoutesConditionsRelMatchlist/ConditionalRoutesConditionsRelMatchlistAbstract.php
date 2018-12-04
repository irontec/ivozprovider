<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * ConditionalRoutesConditionsRelMatchlistAbstract
 * @codeCoverageIgnore
 */
abstract class ConditionalRoutesConditionsRelMatchlistAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface
     */
    protected $condition;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $matchlist;


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
            "ConditionalRoutesConditionsRelMatchlist",
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
     * @return ConditionalRoutesConditionsRelMatchlistDto
     */
    public static function createDto($id = null)
    {
        return new ConditionalRoutesConditionsRelMatchlistDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return ConditionalRoutesConditionsRelMatchlistDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ConditionalRoutesConditionsRelMatchlistInterface::class);

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
         * @var $dto ConditionalRoutesConditionsRelMatchlistDto
         */
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDto::class);

        $self = new static();

        $self
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()))
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
         * @var $dto ConditionalRoutesConditionsRelMatchlistDto
         */
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDto::class);

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConditionalRoutesConditionsRelMatchlistDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setMatchlist(\Ivoz\Provider\Domain\Model\MatchList\MatchList::entityToDto(self::getMatchlist(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'conditionId' => self::getCondition() ? self::getCondition()->getId() : null,
            'matchlistId' => self::getMatchlist() ? self::getMatchlist()->getId() : null
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
     * Set matchlist
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchlist
     *
     * @return self
     */
    public function setMatchlist(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchlist)
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    /**
     * Get matchlist
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchlist()
    {
        return $this->matchlist;
    }

    // @codeCoverageIgnoreEnd
}
