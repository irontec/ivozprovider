<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RatingPlanGroupDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
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
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Currency\CurrencyDto | null
     */
    private $currency;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto[] | null
     */
    private $ratingPlan = null;


    use DtoNormalizer;

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
            'name' => ['en','es','ca','it'],
            'description' => ['en','es','ca','it'],
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
                'it' => $this->getNameIt()
            ],
            'description' => [
                'en' => $this->getDescriptionEn(),
                'es' => $this->getDescriptionEs(),
                'ca' => $this->getDescriptionCa(),
                'it' => $this->getDescriptionIt()
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
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nameEn
     *
     * @return static
     */
    public function setNameEn($nameEn = null)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return static
     */
    public function setNameEs($nameEs = null)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa
     *
     * @return static
     */
    public function setNameCa($nameCa = null)
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa()
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt
     *
     * @return static
     */
    public function setNameIt($nameIt = null)
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt()
    {
        return $this->nameIt;
    }

    /**
     * @param string $descriptionEn
     *
     * @return static
     */
    public function setDescriptionEn($descriptionEn = null)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs
     *
     * @return static
     */
    public function setDescriptionEs($descriptionEs = null)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }

    /**
     * @param string $descriptionCa
     *
     * @return static
     */
    public function setDescriptionCa($descriptionCa = null)
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionCa()
    {
        return $this->descriptionCa;
    }

    /**
     * @param string $descriptionIt
     *
     * @return static
     */
    public function setDescriptionIt($descriptionIt = null)
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionIt()
    {
        return $this->descriptionIt;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyDto $currency
     *
     * @return static
     */
    public function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyDto $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyDto | null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCurrencyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Currency\CurrencyDto($id)
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
     * @param array $ratingPlan
     *
     * @return static
     */
    public function setRatingPlan($ratingPlan = null)
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }
}
