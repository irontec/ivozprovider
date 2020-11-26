<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* SpecialNumberDtoAbstract
* @codeCoverageIgnore
*/
abstract class SpecialNumberDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string | null
     */
    private $numberE164;

    /**
     * @var int
     */
    private $disableCDR = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CountryDto | null
     */
    private $country;

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
        $response = [
            'number' => $this->getNumber(),
            'numberE164' => $this->getNumberE164(),
            'disableCDR' => $this->getDisableCDR(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'country' => $this->getCountry()
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
     * @param string $number | null
     *
     * @return static
     */
    public function setNumber(?string $number = null): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $numberE164 | null
     *
     * @return static
     */
    public function setNumberE164(?string $numberE164 = null): self
    {
        $this->numberE164 = $numberE164;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumberE164(): ?string
    {
        return $this->numberE164;
    }

    /**
     * @param int $disableCDR | null
     *
     * @return static
     */
    public function setDisableCDR(?int $disableCDR = null): self
    {
        $this->disableCDR = $disableCDR;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getDisableCDR(): ?int
    {
        return $this->disableCDR;
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

}
