<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto;

/**
* TransformationRuleSetDtoAbstract
* @codeCoverageIgnore
*/
abstract class TransformationRuleSetDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string | null
     */
    private $description;

    /**
     * @var string | null
     */
    private $internationalCode = '00';

    /**
     * @var string | null
     */
    private $trunkPrefix = '';

    /**
     * @var string | null
     */
    private $areaCode = '';

    /**
     * @var int | null
     */
    private $nationalLen = 9;

    /**
     * @var bool | null
     */
    private $generateRules = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn;

    /**
     * @var string
     */
    private $nameEs;

    /**
     * @var string
     */
    private $nameCa;

    /**
     * @var string
     */
    private $nameIt;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CountryDto | null
     */
    private $country;

    /**
     * @var TransformationRuleDto[] | null
     */
    private $rules;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'description' => 'description',
            'internationalCode' => 'internationalCode',
            'trunkPrefix' => 'trunkPrefix',
            'areaCode' => 'areaCode',
            'nationalLen' => 'nationalLen',
            'generateRules' => 'generateRules',
            'id' => 'id',
            'name' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'brandId' => 'brand',
            'countryId' => 'country'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'description' => $this->getDescription(),
            'internationalCode' => $this->getInternationalCode(),
            'trunkPrefix' => $this->getTrunkPrefix(),
            'areaCode' => $this->getAreaCode(),
            'nationalLen' => $this->getNationalLen(),
            'generateRules' => $this->getGenerateRules(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt(),
            ],
            'brand' => $this->getBrand(),
            'country' => $this->getCountry(),
            'rules' => $this->getRules()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $internationalCode | null
     *
     * @return static
     */
    public function setInternationalCode(?string $internationalCode = null): self
    {
        $this->internationalCode = $internationalCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInternationalCode(): ?string
    {
        return $this->internationalCode;
    }

    /**
     * @param string $trunkPrefix | null
     *
     * @return static
     */
    public function setTrunkPrefix(?string $trunkPrefix = null): self
    {
        $this->trunkPrefix = $trunkPrefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTrunkPrefix(): ?string
    {
        return $this->trunkPrefix;
    }

    /**
     * @param string $areaCode | null
     *
     * @return static
     */
    public function setAreaCode(?string $areaCode = null): self
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    /**
     * @param int $nationalLen | null
     *
     * @return static
     */
    public function setNationalLen(?int $nationalLen = null): self
    {
        $this->nationalLen = $nationalLen;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getNationalLen(): ?int
    {
        return $this->nationalLen;
    }

    /**
     * @param bool $generateRules | null
     *
     * @return static
     */
    public function setGenerateRules(?bool $generateRules = null): self
    {
        $this->generateRules = $generateRules;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getGenerateRules(): ?bool
    {
        return $this->generateRules;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $nameEn | null
     *
     * @return static
     */
    public function setNameEn(?string $nameEn = null): self
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs | null
     *
     * @return static
     */
    public function setNameEs(?string $nameEs = null): self
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa | null
     *
     * @return static
     */
    public function setNameCa(?string $nameCa = null): self
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt | null
     *
     * @return static
     */
    public function setNameIt(?string $nameIt = null): self
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt(): ?string
    {
        return $this->nameIt;
    }

    /**
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setCountry(?CountryDto $country = null): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getCountry(): ?CountryDto
    {
        return $this->country;
    }

    /**
     * @return static
     */
    public function setCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TransformationRuleDto[] | null
     *
     * @return static
     */
    public function setRules(?array $rules = null): self
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @return TransformationRuleDto[] | null
     */
    public function getRules(): ?array
    {
        return $this->rules;
    }

}
