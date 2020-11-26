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
     * @var string
     */
    private $descriptionEn;

    /**
     * @var string
     */
    private $descriptionEs;

    /**
     * @var string
     */
    private $descriptionCa;

    /**
     * @var string
     */
    private $descriptionIt;

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
     * @param string $descriptionEn | null
     *
     * @return static
     */
    public function setDescriptionEn(?string $descriptionEn = null): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs | null
     *
     * @return static
     */
    public function setDescriptionEs(?string $descriptionEs = null): self
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    /**
     * @param string $descriptionCa | null
     *
     * @return static
     */
    public function setDescriptionCa(?string $descriptionCa = null): self
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionCa(): ?string
    {
        return $this->descriptionCa;
    }

    /**
     * @param string $descriptionIt | null
     *
     * @return static
     */
    public function setDescriptionIt(?string $descriptionIt = null): self
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionIt(): ?string
    {
        return $this->descriptionIt;
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
     * @param CurrencyDto | null
     *
     * @return static
     */
    public function setCurrency(?CurrencyDto $currency = null): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return CurrencyDto | null
     */
    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    /**
     * @return static
     */
    public function setCurrencyId($id): self
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    /**
     * @return mixed | null
     */
    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RatingPlanDto[] | null
     *
     * @return static
     */
    public function setRatingPlan(?array $ratingPlan = null): self
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * @return RatingPlanDto[] | null
     */
    public function getRatingPlan(): ?array
    {
        return $this->ratingPlan;
    }

}
