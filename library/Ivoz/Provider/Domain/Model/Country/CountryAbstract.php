<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CountryAbstract
 * @codeCoverageIgnore
 */
abstract class CountryAbstract
{
    /**
     * @var string
     */
    protected $code = '';

    /**
     * @var string | null
     */
    protected $countryCode;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Zone
     */
    protected $zone;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($code, Name $name, Zone $zone)
    {
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
     * @param null $id
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
        $dto = $entity->toDto($depth-1);

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCountryCode($dto->getCountryCode())
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
    // @codeCoverageIgnoreStart

    /**
     * Set code
     *
     * @param string $code
     *
     * @return static
     */
    protected function setCode($code)
    {
        Assertion::notNull($code, 'code value "%s" is null, but non null value was expected.');
        Assertion::maxLength($code, 100, 'code value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode | null
     *
     * @return static
     */
    protected function setCountryCode($countryCode = null)
    {
        if (!is_null($countryCode)) {
            Assertion::maxLength($countryCode, 10, 'countryCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string | null
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Country\Name $name
     *
     * @return static
     */
    public function setName(Name $name)
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set zone
     *
     * @param \Ivoz\Provider\Domain\Model\Country\Zone $zone
     *
     * @return static
     */
    public function setZone(Zone $zone)
    {
        $isEqual = $this->zone && $this->zone->equals($zone);
        if ($isEqual) {
            return $this;
        }

        $this->zone = $zone;
        return $this;
    }

    /**
     * Get zone
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Zone
     */
    public function getZone()
    {
        return $this->zone;
    }
    // @codeCoverageIgnoreEnd
}
