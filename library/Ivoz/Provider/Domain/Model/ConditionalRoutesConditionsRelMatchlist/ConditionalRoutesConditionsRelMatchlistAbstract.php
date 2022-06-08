<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var ?ConditionalRoutesConditionInterface
     * inversedBy relMatchlists
     */
    protected $condition = null;

    /**
     * @var MatchListInterface
     */
    protected $matchlist;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoutesConditionsRelMatchlist",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ConditionalRoutesConditionsRelMatchlistDto
    {
        return new ConditionalRoutesConditionsRelMatchlistDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ConditionalRoutesConditionsRelMatchlistInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ConditionalRoutesConditionsRelMatchlistDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelMatchlistDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDto::class);
        $matchlist = $dto->getMatchlist();
        Assertion::notNull($matchlist, 'getMatchlist value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setMatchlist($fkTransformer->transform($matchlist));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelMatchlistDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDto::class);

        $matchlist = $dto->getMatchlist();
        Assertion::notNull($matchlist, 'getMatchlist value is null, but non null value was expected.');

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setMatchlist($fkTransformer->transform($matchlist));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ConditionalRoutesConditionsRelMatchlistDto
    {
        return self::createDto()
            ->setCondition(ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setMatchlist(MatchList::entityToDto(self::getMatchlist(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'conditionId' => self::getCondition()?->getId(),
            'matchlistId' => self::getMatchlist()->getId()
        ];
    }

    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): static
    {
        $this->condition = $condition;

        return $this;
    }

    public function getCondition(): ?ConditionalRoutesConditionInterface
    {
        return $this->condition;
    }

    protected function setMatchlist(MatchListInterface $matchlist): static
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    public function getMatchlist(): MatchListInterface
    {
        return $this->matchlist;
    }
}
