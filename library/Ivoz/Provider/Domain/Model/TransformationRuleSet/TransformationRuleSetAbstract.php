<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TransformationRuleSetAbstract
 * @codeCoverageIgnore
 */
abstract class TransformationRuleSetAbstract
{
    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $internationalCode = '00';

    /**
     * @var string
     */
    protected $trunkPrefix = '';

    /**
     * @var string
     */
    protected $areaCode = '';

    /**
     * @var integer
     */
    protected $nationalLen = 9;

    /**
     * @var boolean
     */
    protected $generateRules = 0;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
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
    protected function __construct(Name $name)
    {
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "TransformationRuleSet",
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
     * @return TransformationRuleSetDto
     */
    public static function createDto($id = null)
    {
        return new TransformationRuleSetDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TransformationRuleSetDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TransformationRuleSetInterface::class);

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
         * @var $dto TransformationRuleSetDto
         */
        Assertion::isInstanceOf($dto, TransformationRuleSetDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $self = new static(
            $name
        );

        $self
            ->setDescription($dto->getDescription())
            ->setInternationalCode($dto->getInternationalCode())
            ->setTrunkPrefix($dto->getTrunkPrefix())
            ->setAreaCode($dto->getAreaCode())
            ->setNationalLen($dto->getNationalLen())
            ->setGenerateRules($dto->getGenerateRules())
            ->setBrand($dto->getBrand())
            ->setCountry($dto->getCountry())
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
         * @var $dto TransformationRuleSetDto
         */
        Assertion::isInstanceOf($dto, TransformationRuleSetDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $this
            ->setDescription($dto->getDescription())
            ->setInternationalCode($dto->getInternationalCode())
            ->setTrunkPrefix($dto->getTrunkPrefix())
            ->setAreaCode($dto->getAreaCode())
            ->setNationalLen($dto->getNationalLen())
            ->setGenerateRules($dto->getGenerateRules())
            ->setName($name)
            ->setBrand($dto->getBrand())
            ->setCountry($dto->getCountry());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TransformationRuleSetDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setDescription($this->getDescription())
            ->setInternationalCode($this->getInternationalCode())
            ->setTrunkPrefix($this->getTrunkPrefix())
            ->setAreaCode($this->getAreaCode())
            ->setNationalLen($this->getNationalLen())
            ->setGenerateRules($this->getGenerateRules())
            ->setNameEn($this->getName()->getEn())
            ->setNameEs($this->getName()->getEs())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto($this->getBrand(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto($this->getCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'description' => self::getDescription(),
            'internationalCode' => self::getInternationalCode(),
            'trunkPrefix' => self::getTrunkPrefix(),
            'areaCode' => self::getAreaCode(),
            'nationalLen' => self::getNationalLen(),
            'generateRules' => self::getGenerateRules(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 250, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set internationalCode
     *
     * @param string $internationalCode
     *
     * @return self
     */
    public function setInternationalCode($internationalCode = null)
    {
        if (!is_null($internationalCode)) {
            Assertion::maxLength($internationalCode, 10, 'internationalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->internationalCode = $internationalCode;

        return $this;
    }

    /**
     * Get internationalCode
     *
     * @return string
     */
    public function getInternationalCode()
    {
        return $this->internationalCode;
    }

    /**
     * Set trunkPrefix
     *
     * @param string $trunkPrefix
     *
     * @return self
     */
    public function setTrunkPrefix($trunkPrefix = null)
    {
        if (!is_null($trunkPrefix)) {
            Assertion::maxLength($trunkPrefix, 5, 'trunkPrefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->trunkPrefix = $trunkPrefix;

        return $this;
    }

    /**
     * Get trunkPrefix
     *
     * @return string
     */
    public function getTrunkPrefix()
    {
        return $this->trunkPrefix;
    }

    /**
     * Set areaCode
     *
     * @param string $areaCode
     *
     * @return self
     */
    public function setAreaCode($areaCode = null)
    {
        if (!is_null($areaCode)) {
            Assertion::maxLength($areaCode, 5, 'areaCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * Get areaCode
     *
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * Set nationalLen
     *
     * @param integer $nationalLen
     *
     * @return self
     */
    public function setNationalLen($nationalLen = null)
    {
        if (!is_null($nationalLen)) {
            if (!is_null($nationalLen)) {
                Assertion::integerish($nationalLen, 'nationalLen value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($nationalLen, 0, 'nationalLen provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->nationalLen = $nationalLen;

        return $this;
    }

    /**
     * Get nationalLen
     *
     * @return integer
     */
    public function getNationalLen()
    {
        return $this->nationalLen;
    }

    /**
     * Set generateRules
     *
     * @param boolean $generateRules
     *
     * @return self
     */
    public function setGenerateRules($generateRules = null)
    {
        if (!is_null($generateRules)) {
            Assertion::between(intval($generateRules), 0, 1, 'generateRules provided "%s" is not a valid boolean value.');
        }

        $this->generateRules = $generateRules;

        return $this;
    }

    /**
     * Get generateRules
     *
     * @return boolean
     */
    public function getGenerateRules()
    {
        return $this->generateRules;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
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
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
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

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\Name $name
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
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\Name
     */
    public function getName()
    {
        return $this->name;
    }

    // @codeCoverageIgnoreEnd
}

