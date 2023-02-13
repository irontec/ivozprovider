<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* MatchListPatternAbstract
* @codeCoverageIgnore
*/
abstract class MatchListPatternAbstract
{
    use ChangelogTrait;

    /**
     * @var ?string
     */
    protected $description = null;

    /**
     * @var string
     * comment: enum:number|regexp
     */
    protected $type;

    /**
     * @var ?string
     * column: regExp
     */
    protected $regexp = null;

    /**
     * @var ?string
     * column: numberValue
     */
    protected $numbervalue = null;

    /**
     * @var MatchListInterface
     * inversedBy patterns
     */
    protected $matchList;

    /**
     * @var ?CountryInterface
     */
    protected $numberCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $type
    ) {
        $this->setType($type);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "MatchListPattern",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): MatchListPatternDto
    {
        return new MatchListPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|MatchListPatternInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MatchListPatternDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MatchListPatternInterface::class);

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
     * @param MatchListPatternDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MatchListPatternDto::class);
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $matchList = $dto->getMatchList();
        Assertion::notNull($matchList, 'getMatchList value is null, but non null value was expected.');

        $self = new static(
            $type
        );

        $self
            ->setDescription($dto->getDescription())
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($fkTransformer->transform($matchList))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param MatchListPatternDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MatchListPatternDto::class);

        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $matchList = $dto->getMatchList();
        Assertion::notNull($matchList, 'getMatchList value is null, but non null value was expected.');

        $this
            ->setDescription($dto->getDescription())
            ->setType($type)
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($fkTransformer->transform($matchList))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MatchListPatternDto
    {
        return self::createDto()
            ->setDescription(self::getDescription())
            ->setType(self::getType())
            ->setRegexp(self::getRegexp())
            ->setNumbervalue(self::getNumbervalue())
            ->setMatchList(MatchList::entityToDto(self::getMatchList(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'description' => self::getDescription(),
            'type' => self::getType(),
            'regExp' => self::getRegexp(),
            'numberValue' => self::getNumbervalue(),
            'matchListId' => self::getMatchList()->getId(),
            'numberCountryId' => self::getNumberCountry()?->getId()
        ];
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 55, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 10, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                MatchListPatternInterface::TYPE_NUMBER,
                MatchListPatternInterface::TYPE_REGEXP,
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

    protected function setRegexp(?string $regexp = null): static
    {
        if (!is_null($regexp)) {
            Assertion::maxLength($regexp, 255, 'regexp value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->regexp = $regexp;

        return $this;
    }

    public function getRegexp(): ?string
    {
        return $this->regexp;
    }

    protected function setNumbervalue(?string $numbervalue = null): static
    {
        if (!is_null($numbervalue)) {
            Assertion::maxLength($numbervalue, 25, 'numbervalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numbervalue = $numbervalue;

        return $this;
    }

    public function getNumbervalue(): ?string
    {
        return $this->numbervalue;
    }

    public function setMatchList(MatchListInterface $matchList): static
    {
        $this->matchList = $matchList;

        return $this;
    }

    public function getMatchList(): MatchListInterface
    {
        return $this->matchList;
    }

    protected function setNumberCountry(?CountryInterface $numberCountry = null): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryInterface
    {
        return $this->numberCountry;
    }
}
