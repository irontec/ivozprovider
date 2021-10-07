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
     * @var string | null
     */
    protected $countryCode;

    /**
     * @var Name | null
     */
    protected $name;

    /**
     * @var Zone | null
     */
    protected $zone;

    /**
     * Constructor
     */
    protected function __construct(
        $code,
        Name $name,
        Zone $zone
    ) {
        $this->setCode($code);
        $this->setName($name);
        $this->setZone($zone);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Country",
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
     * @return CountryDto
     */
    public static function createDto($id = null)
    {
        return new CountryDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CountryInterface|null $entity
     * @param int $depth
     * @return CountryDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var CountryDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CountryDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return CountryDto
     */
    public function toDto($depth = 0)
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

    /**
     * @return array
     */
    protected function __toArray()
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
        $isEqual = $this->name && $this->name->equals($name);
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
        $isEqual = $this->zone && $this->zone->equals($zone);
        if ($isEqual) {
            return $this;
        }

        $this->zone = $zone;
        return $this;
    }
}
