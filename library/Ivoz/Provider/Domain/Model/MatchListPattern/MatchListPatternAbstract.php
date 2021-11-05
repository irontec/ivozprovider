<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    protected $description;

    /**
     * comment: enum:number|regexp
     */
    protected $type;

    /**
     * column: regExp
     */
    protected $regexp;

    /**
     * column: numberValue
     */
    protected $numbervalue;

    /**
     * @var MatchListInterface
     * inversedBy patterns
     */
    protected $matchList;

    /**
     * @var CountryInterface | null
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        string $type
    ) {
        $this->setType($type);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "MatchListPattern",
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
     * @param mixed $id
     */
    public static function createDto($id = null): MatchListPatternDto
    {
        return new MatchListPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param MatchListPatternInterface|null $entity
     * @param int $depth
     * @return MatchListPatternDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var MatchListPatternDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param MatchListPatternDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, MatchListPatternDto::class);

        $self = new static(
            $dto->getType()
        );

        $self
            ->setDescription($dto->getDescription())
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param MatchListPatternDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, MatchListPatternDto::class);

        $this
            ->setDescription($dto->getDescription())
            ->setType($dto->getType())
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): MatchListPatternDto
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
     * @return array
     */
    protected function __toArray()
    {
        return [
            'description' => self::getDescription(),
            'type' => self::getType(),
            'regExp' => self::getRegexp(),
            'numberValue' => self::getNumbervalue(),
            'matchListId' => self::getMatchList()->getId(),
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
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
