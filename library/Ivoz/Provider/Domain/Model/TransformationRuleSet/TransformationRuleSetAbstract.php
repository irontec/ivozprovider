<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\Name;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* TransformationRuleSetAbstract
* @codeCoverageIgnore
*/
abstract class TransformationRuleSetAbstract
{
    use ChangelogTrait;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var string | null
     */
    protected $internationalCode = '00';

    /**
     * @var string | null
     */
    protected $trunkPrefix = '';

    /**
     * @var string | null
     */
    protected $areaCode = '';

    /**
     * @var int | null
     */
    protected $nationalLen = 9;

    /**
     * @var bool | null
     */
    protected $generateRules = false;

    /**
     * @var Name | null
     */
    protected $name;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * Constructor
     */
    protected function __construct(
        Name $name
    ) {
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
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
     * @internal use EntityTools instead
     * @param TransformationRuleSetInterface|null $entity
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

        /** @var TransformationRuleSetDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TransformationRuleSetDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TransformationRuleSetDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
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
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TransformationRuleSetDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TransformationRuleSetDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $this
            ->setDescription($dto->getDescription())
            ->setInternationalCode($dto->getInternationalCode())
            ->setTrunkPrefix($dto->getTrunkPrefix())
            ->setAreaCode($dto->getAreaCode())
            ->setNationalLen($dto->getNationalLen())
            ->setGenerateRules($dto->getGenerateRules())
            ->setName($name)
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TransformationRuleSetDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setDescription(self::getDescription())
            ->setInternationalCode(self::getInternationalCode())
            ->setTrunkPrefix(self::getTrunkPrefix())
            ->setAreaCode(self::getAreaCode())
            ->setNationalLen(self::getNationalLen())
            ->setGenerateRules(self::getGenerateRules())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCountry(Country::entityToDto(self::getCountry(), $depth));
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
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null
        ];
    }

    /**
     * Set description
     *
     * @param string $description | null
     *
     * @return static
     */
    protected function setDescription(?string $description = null): TransformationRuleSetInterface
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
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set internationalCode
     *
     * @param string $internationalCode | null
     *
     * @return static
     */
    protected function setInternationalCode(?string $internationalCode = null): TransformationRuleSetInterface
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
     * @return string | null
     */
    public function getInternationalCode(): ?string
    {
        return $this->internationalCode;
    }

    /**
     * Set trunkPrefix
     *
     * @param string $trunkPrefix | null
     *
     * @return static
     */
    protected function setTrunkPrefix(?string $trunkPrefix = null): TransformationRuleSetInterface
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
     * @return string | null
     */
    public function getTrunkPrefix(): ?string
    {
        return $this->trunkPrefix;
    }

    /**
     * Set areaCode
     *
     * @param string $areaCode | null
     *
     * @return static
     */
    protected function setAreaCode(?string $areaCode = null): TransformationRuleSetInterface
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
     * @return string | null
     */
    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    /**
     * Set nationalLen
     *
     * @param int $nationalLen | null
     *
     * @return static
     */
    protected function setNationalLen(?int $nationalLen = null): TransformationRuleSetInterface
    {
        if (!is_null($nationalLen)) {
            Assertion::greaterOrEqualThan($nationalLen, 0, 'nationalLen provided "%s" is not greater or equal than "%s".');
        }

        $this->nationalLen = $nationalLen;

        return $this;
    }

    /**
     * Get nationalLen
     *
     * @return int | null
     */
    public function getNationalLen(): ?int
    {
        return $this->nationalLen;
    }

    /**
     * Set generateRules
     *
     * @param bool $generateRules | null
     *
     * @return static
     */
    protected function setGenerateRules(?bool $generateRules = null): TransformationRuleSetInterface
    {
        if (!is_null($generateRules)) {
            Assertion::between(intval($generateRules), 0, 1, 'generateRules provided "%s" is not a valid boolean value.');
            $generateRules = (bool) $generateRules;
        }

        $this->generateRules = $generateRules;

        return $this;
    }

    /**
     * Get generateRules
     *
     * @return bool | null
     */
    public function getGenerateRules(): ?bool
    {
        return $this->generateRules;
    }

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @return static
     */
    protected function setName(Name $name): TransformationRuleSetInterface
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    protected function setBrand(?BrandInterface $brand = null): TransformationRuleSetInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set country
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setCountry(?CountryInterface $country = null): TransformationRuleSetInterface
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return CountryInterface | null
     */
    public function getCountry(): ?CountryInterface
    {
        return $this->country;
    }

}
