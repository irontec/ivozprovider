<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* CompanyRelGeoIPCountryDtoAbstract
* @codeCoverageIgnore
*/
abstract class CompanyRelGeoIPCountryDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

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
            'id' => 'id',
            'companyId' => 'company',
            'countryId' => 'country'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'company' => $this->getCompany(),
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
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
