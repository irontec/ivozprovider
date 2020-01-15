<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class SpecialNumberDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $numberE164;

    /**
     * @var integer
     */
    private $disableCDR = 1;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $country;


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
            'number' => 'number',
            'numberE164' => 'numberE164',
            'disableCDR' => 'disableCDR',
            'id' => 'id',
            'brandId' => 'brand',
            'countryId' => 'country'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'number' => $this->getNumber(),
            'numberE164' => $this->getNumberE164(),
            'disableCDR' => $this->getDisableCDR(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'country' => $this->getCountry()
        ];
    }

    /**
     * @param string $number
     *
     * @return static
     */
    public function setNumber($number = null)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $numberE164
     *
     * @return static
     */
    public function setNumberE164($numberE164 = null)
    {
        $this->numberE164 = $numberE164;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumberE164()
    {
        return $this->numberE164;
    }

    /**
     * @param integer $disableCDR
     *
     * @return static
     */
    public function setDisableCDR($disableCDR = null)
    {
        $this->disableCDR = $disableCDR;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getDisableCDR()
    {
        return $this->disableCDR;
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
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $country
     *
     * @return static
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
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
}
