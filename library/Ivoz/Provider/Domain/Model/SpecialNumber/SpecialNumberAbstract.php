<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * SpecialNumberAbstract
 * @codeCoverageIgnore
 */
abstract class SpecialNumberAbstract
{
    /**
     * @var string
     */
    protected $number;

    /**
     * @var string | null
     */
    protected $numberE164;

    /**
     * @var integer
     */
    protected $disableCDR = 1;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $country;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($number, $disableCDR)
    {
        $this->setNumber($number);
        $this->setDisableCDR($disableCDR);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "SpecialNumber",
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
     * @return SpecialNumberDto
     */
    public static function createDto($id = null)
    {
        return new SpecialNumberDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param SpecialNumberInterface|null $entity
     * @param int $depth
     * @return SpecialNumberDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, SpecialNumberInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var SpecialNumberDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param SpecialNumberDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, SpecialNumberDto::class);

        $self = new static(
            $dto->getNumber(),
            $dto->getDisableCDR()
        );

        $self
            ->setNumberE164($dto->getNumberE164())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCountry($fkTransformer->transform($dto->getCountry()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param SpecialNumberDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, SpecialNumberDto::class);

        $this
            ->setNumber($dto->getNumber())
            ->setNumberE164($dto->getNumberE164())
            ->setDisableCDR($dto->getDisableCDR())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return SpecialNumberDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setNumber(self::getNumber())
            ->setNumberE164(self::getNumberE164())
            ->setDisableCDR(self::getDisableCDR())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'number' => self::getNumber(),
            'numberE164' => self::getNumberE164(),
            'disableCDR' => self::getDisableCDR(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'countryId' => self::getCountry()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set number
     *
     * @param string $number
     *
     * @return static
     */
    protected function setNumber($number)
    {
        Assertion::notNull($number, 'number value "%s" is null, but non null value was expected.');
        Assertion::maxLength($number, 25, 'number value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set numberE164
     *
     * @param string $numberE164 | null
     *
     * @return static
     */
    protected function setNumberE164($numberE164 = null)
    {
        if (!is_null($numberE164)) {
            Assertion::maxLength($numberE164, 25, 'numberE164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberE164 = $numberE164;

        return $this;
    }

    /**
     * Get numberE164
     *
     * @return string | null
     */
    public function getNumberE164()
    {
        return $this->numberE164;
    }

    /**
     * Set disableCDR
     *
     * @param integer $disableCDR
     *
     * @return static
     */
    protected function setDisableCDR($disableCDR)
    {
        Assertion::notNull($disableCDR, 'disableCDR value "%s" is null, but non null value was expected.');
        Assertion::integerish($disableCDR, 'disableCDR value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($disableCDR, 0, 'disableCDR provided "%s" is not greater or equal than "%s".');

        $this->disableCDR = (int) $disableCDR;

        return $this;
    }

    /**
     * Get disableCDR
     *
     * @return integer
     */
    public function getDisableCDR()
    {
        return $this->disableCDR;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    protected function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return static
     */
    protected function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    // @codeCoverageIgnoreEnd
}
