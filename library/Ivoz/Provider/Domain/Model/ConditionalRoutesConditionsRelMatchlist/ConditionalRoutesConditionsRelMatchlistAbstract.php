<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;

/**
* ConditionalRoutesConditionsRelMatchlistAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionsRelMatchlistAbstract
{
    use ChangelogTrait;

    /**
     * @var ConditionalRoutesConditionInterface
     * inversedBy relMatchlists
     */
    protected $condition;

    /**
     * @var MatchListInterface
     */
    protected $matchlist;

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
     * @param ConditionalRoutesConditionsRelMatchlistInterface|null $entity
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

        /** @var ConditionalRoutesConditionsRelMatchlistDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelMatchlistDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDto::class);

        $self = new static(

        );

        $self
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelMatchlistDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDto::class);

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setMatchlist($fkTransformer->transform($dto->getMatchlist()));

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
            ->setCondition(ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setMatchlist(MatchList::entityToDto(self::getMatchlist(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'conditionId' => self::getCondition() ? self::getCondition()->getId() : null,
            'matchlistId' => self::getMatchlist()->getId()
        ];
    }

    /**
     * Set condition
     *
     * @param ConditionalRoutesConditionInterface | null
     *
     * @return static
     */
    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): ConditionalRoutesConditionsRelMatchlistInterface
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
     * Set matchlist
     *
     * @param MatchListInterface
     *
     * @return static
     */
    protected function setMatchlist(MatchListInterface $matchlist): ConditionalRoutesConditionsRelMatchlistInterface
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    /**
     * Get matchlist
     *
     * @return MatchListInterface
     */
    public function getMatchlist(): MatchListInterface
    {
        return $this->matchlist;
    }

}
