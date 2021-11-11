<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Country;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Country\Name;
use Ivoz\Provider\Domain\Model\Country\Zone;

/**
* CountryAbstract
* @codeCoverageIgnore
*/
abstract class CountryAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $code = '';

    /**
     * @var ?string
     */
    protected $countryCode = null;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Zone
     */
    protected $zone;

    /**
     * Constructor
     */
    protected function __construct(
        string $code,
        Name $name,
        Zone $zone
    ) {
        $this->setCode($code);
        $this->name = $name;
        $this->zone = $zone;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Country",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CountryDto
    {
        return new CountryDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CountryInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CountryDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CountryInterface::class);

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
     * @param CountryDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CountryDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $zone = new Zone(
            $dto->getZoneEn(),
            $dto->getZoneEs(),
            $dto->getZoneCa(),
            $dto->getZoneIt()
        );

        $self = new static(
            $dto->getCode(),
            $name,
            $zone
        );

        $self
            ->setCountryCode($dto->getCountryCode());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CountryDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CountryDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $zone = new Zone(
            $dto->getZoneEn(),
            $dto->getZoneEs(),
            $dto->getZoneCa(),
            $dto->getZoneIt()
        );

        $this
            ->setCode($dto->getCode())
            ->setCountryCode($dto->getCountryCode())
            ->setName($name)
            ->setZone($zone);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CountryDto
    {
        return self::createDto()
            ->setCode(self::getCode())
            ->setCountryCode(self::getCountryCode())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setZoneEn(self::getZone()->getEn())
            ->setZoneEs(self::getZone()->getEs())
            ->setZoneCa(self::getZone()->getCa())
            ->setZoneIt(self::getZone()->getIt());
    }

    protected function __toArray(): array
    {
        return [
            'code' => self::getCode(),
            'countryCode' => self::getCountryCode(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'zoneEn' => self::getZone()->getEn(),
            'zoneEs' => self::getZone()->getEs(),
            'zoneCa' => self::getZone()->getCa(),
            'zoneIt' => self::getZone()->getIt()
        ];
    }

    protected function setCode(string $code): static
    {
        Assertion::maxLength($code, 100, 'code value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->code = $code;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    protected function setCountryCode(?string $countryCode = null): static
    {
        if (!is_null($countryCode)) {
            Assertion::maxLength($countryCode, 10, 'countryCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->countryCode = $countryCode;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    protected function setName(Name $name): static
    {
        $isEqual = $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    public function getZone(): Zone
    {
        return $this->zone;
    }

    protected function setZone(Zone $zone): static
    {
        $isEqual = $this->zone->equals($zone);
        if ($isEqual) {
            return $this;
        }

        $this->zone = $zone;
        return $this;
    }
}
