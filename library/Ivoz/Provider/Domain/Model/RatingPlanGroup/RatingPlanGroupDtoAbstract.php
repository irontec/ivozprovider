<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;

/**
* RatingPlanGroupDtoAbstract
* @codeCoverageIgnore
*/
abstract class RatingPlanGroupDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn = '';

    /**
     * @var string
     */
    private $nameEs = '';

    /**
     * @var string
     */
    private $nameCa = '';

    /**
     * @var string
     */
    private $nameIt = '';

    /**
     * @var string
     */
    private $descriptionEn = '';

    /**
     * @var string
     */
    private $descriptionEs = '';

    /**
     * @var string
     */
    private $descriptionCa = '';

    /**
     * @var string
     */
    private $descriptionIt = '';

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CurrencyDto | null
     */
    private $currency;

    /**
     * @var RatingPlanDto[] | null
     */
    private $ratingPlan;

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
            'id' => 'id',
            'name' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'description' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'brandId' => 'brand',
            'currencyId' => 'currency'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt(),
            ],
            'description' => [
                'en' => $this->getDescriptionEn(),
                'es' => $this->getDescriptionEs(),
                'ca' => $this->getDescriptionCa(),
                'it' => $this->getDescriptionIt(),
            ],
            'brand' => $this->getBrand(),
            'currency' => $this->getCurrency(),
            'ratingPlan' => $this->getRatingPlan()
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNameEn(?string $nameEn): static
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEs(?string $nameEs): static
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    public function setNameCa(?string $nameCa): static
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    public function setNameIt(?string $nameIt): static
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    public function getNameIt(): ?string
    {
        return $this->nameIt;
    }

    public function setDescriptionEn(?string $descriptionEn): static
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEs(?string $descriptionEs): static
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    public function setDescriptionCa(?string $descriptionCa): static
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    public function getDescriptionCa(): ?string
    {
        return $this->descriptionCa;
    }

    public function setDescriptionIt(?string $descriptionIt): static
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    public function getDescriptionIt(): ?string
    {
        return $this->descriptionIt;
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

    public function setCurrency(?CurrencyDto $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    public function setCurrencyId($id): static
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRatingPlan(?array $ratingPlan): static
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    public function getRatingPlan(): ?array
    {
        return $this->ratingPlan;
    }

}
