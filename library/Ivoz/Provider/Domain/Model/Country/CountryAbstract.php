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
     * @var string
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
        return sprintf("%s#%s",
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CountryDto
         */
        Assertion::isInstanceOf($dto, CountryDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $zone = new Zone(
            $dto->getZoneEn(),
            $dto->getZoneEs()
        );

        $self = new static(
            $dto->getCode(),
            $name,
            $zone
        );

        $self
            ->setCountryCode($dto->getCountryCode())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CountryDto
         */
        Assertion::isInstanceOf($dto, CountryDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $zone = new Zone(
            $dto->getZoneEn(),
            $dto->getZoneEs()
        );

        $this
            ->setCode($dto->getCode())
            ->setCountryCode($dto->getCountryCode())
            ->setName($name)
            ->setZone($zone);



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return CountryDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCode($this->getCode())
            ->setCountryCode($this->getCountryCode())
            ->setNameEn($this->getName()->getEn())
            ->setNameEs($this->getName()->getEs())
            ->setZoneEn($this->getZone()->getEn())
            ->setZoneEs($this->getZone()->getEs());
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
            'zoneEn' => self::getZone()->getEn(),
            'zoneEs' => self::getZone()->getEs()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set code
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode($code)
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
     * @param string $countryCode
     *
     * @return self
     */
    public function setCountryCode($countryCode = null)
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
     * @return string
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
     * @return self
     */
    public function setName(Name $name)
    {
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
     * @return self
     */
    public function setZone(Zone $zone)
    {
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

