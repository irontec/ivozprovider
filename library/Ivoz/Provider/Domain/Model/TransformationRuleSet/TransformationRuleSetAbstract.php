<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    protected $description;

    protected $internationalCode = '00';

    protected $trunkPrefix = '';

    protected $areaCode = '';

    protected $nationalLen = 9;

    protected $generateRules = false;

    /**
     * @var Name | null
     */
    protected $name;

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * @var CountryInterface | null
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
     * @param mixed $id
     */
    public static function createDto($id = null): TransformationRuleSetDto
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
        $dto = $entity->toDto($depth - 1);

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
     */
    public function toDto($depth = 0): TransformationRuleSetDto
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

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 250, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setInternationalCode(?string $internationalCode = null): static
    {
        if (!is_null($internationalCode)) {
            Assertion::maxLength($internationalCode, 10, 'internationalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->internationalCode = $internationalCode;

        return $this;
    }

    public function getInternationalCode(): ?string
    {
        return $this->internationalCode;
    }

    protected function setTrunkPrefix(?string $trunkPrefix = null): static
    {
        if (!is_null($trunkPrefix)) {
            Assertion::maxLength($trunkPrefix, 5, 'trunkPrefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->trunkPrefix = $trunkPrefix;

        return $this;
    }

    public function getTrunkPrefix(): ?string
    {
        return $this->trunkPrefix;
    }

    protected function setAreaCode(?string $areaCode = null): static
    {
        if (!is_null($areaCode)) {
            Assertion::maxLength($areaCode, 5, 'areaCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->areaCode = $areaCode;

        return $this;
    }

    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    protected function setNationalLen(?int $nationalLen = null): static
    {
        if (!is_null($nationalLen)) {
            Assertion::greaterOrEqualThan($nationalLen, 0, 'nationalLen provided "%s" is not greater or equal than "%s".');
        }

        $this->nationalLen = $nationalLen;

        return $this;
    }

    public function getNationalLen(): ?int
    {
        return $this->nationalLen;
    }

    protected function setGenerateRules(?bool $generateRules = null): static
    {
        $this->generateRules = $generateRules;

        return $this;
    }

    public function getGenerateRules(): ?bool
    {
        return $this->generateRules;
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

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCountry(?CountryInterface $country = null): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): ?CountryInterface
    {
        return $this->country;
    }
}
