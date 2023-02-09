<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* CountryDtoAbstract
* @codeCoverageIgnore
*/
abstract class CountryDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $code = '';

    /**
     * @var string|null
     */
    private $countryCode = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var string|null
     */
    private $nameEn = null;

    /**
     * @var string|null
     */
    private $nameEs = null;

    /**
     * @var string|null
     */
    private $nameCa = null;

    /**
     * @var string|null
     */
    private $nameIt = null;

    /**
     * @var string|null
     */
    private $zoneEn = '';

    /**
     * @var string|null
     */
    private $zoneEs = '';

    /**
     * @var string|null
     */
    private $zoneCa = '';

    /**
     * @var string|null
     */
    private $zoneIt = '';

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
            'code' => 'code',
            'countryCode' => 'countryCode',
            'id' => 'id',
            'name' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'zone' => [
                'en',
                'es',
                'ca',
                'it',
            ]
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'code' => $this->getCode(),
            'countryCode' => $this->getCountryCode(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt(),
            ],
            'zone' => [
                'en' => $this->getZoneEn(),
                'es' => $this->getZoneEs(),
                'ca' => $this->getZoneCa(),
                'it' => $this->getZoneIt(),
            ]
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

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCountryCode(?string $countryCode): static
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
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

    public function setZoneEn(string $zoneEn): static
    {
        $this->zoneEn = $zoneEn;

        return $this;
    }

    public function getZoneEn(): ?string
    {
        return $this->zoneEn;
    }

    public function setZoneEs(string $zoneEs): static
    {
        $this->zoneEs = $zoneEs;

        return $this;
    }

    public function getZoneEs(): ?string
    {
        return $this->zoneEs;
    }

    public function setZoneCa(string $zoneCa): static
    {
        $this->zoneCa = $zoneCa;

        return $this;
    }

    public function getZoneCa(): ?string
    {
        return $this->zoneCa;
    }

    public function setZoneIt(string $zoneIt): static
    {
        $this->zoneIt = $zoneIt;

        return $this;
    }

    public function getZoneIt(): ?string
    {
        return $this->zoneIt;
    }
}
