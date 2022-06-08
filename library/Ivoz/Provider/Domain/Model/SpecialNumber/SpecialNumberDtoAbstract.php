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
     * @var string|null
     */
    private $number = null;

    /**
     * @var string|null
     */
    private $numberE164 = null;

    /**
     * @var int|null
     */
    private $disableCDR = 1;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var CountryDto | null
     */
    private $country = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumberE164(?string $numberE164): static
    {
        $this->numberE164 = $numberE164;

        return $this;
    }

    public function getNumberE164(): ?string
    {
        return $this->numberE164;
    }

    public function setDisableCDR(int $disableCDR): static
    {
        $this->disableCDR = $disableCDR;

        return $this;
    }

    public function getDisableCDR(): ?int
    {
        return $this->disableCDR;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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
}
