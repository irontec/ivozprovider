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
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $internationalCode = '00';

    /**
     * @var string|null
     */
    private $trunkPrefix = '';

    /**
     * @var string|null
     */
    private $areaCode = '';

    /**
     * @var int|null
     */
    private $nationalLen = 9;

    /**
     * @var bool|null
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setInternationalCode(?string $internationalCode): static
    {
        $this->internationalCode = $internationalCode;

        return $this;
    }

    public function getInternationalCode(): ?string
    {
        return $this->internationalCode;
    }

    public function setTrunkPrefix(?string $trunkPrefix): static
    {
        $this->trunkPrefix = $trunkPrefix;

        return $this;
    }

    public function getTrunkPrefix(): ?string
    {
        return $this->trunkPrefix;
    }

    public function setAreaCode(?string $areaCode): static
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    public function setNationalLen(?int $nationalLen): static
    {
        $this->nationalLen = $nationalLen;

        return $this;
    }

    public function getNationalLen(): ?int
    {
        return $this->nationalLen;
    }

    public function setGenerateRules(?bool $generateRules): static
    {
        $this->generateRules = $generateRules;

        return $this;
    }

    public function getGenerateRules(): ?bool
    {
        return $this->generateRules;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNameEn(string $nameEn): static
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEs(string $nameEs): static
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    public function setNameCa(string $nameCa): static
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    public function setNameIt(string $nameIt): static
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    public function getNameIt(): ?string
    {
        return $this->nameIt;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCountry(?CountryDto $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): ?CountryDto
    {
        return $this->country;
    }

    public function setCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRules(?array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    public function getRules(): ?array
    {
        return $this->rules;
    }
}
