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
     * @var string
     */
    private $code = '';

    /**
     * @var string | null
     */
    private $countryCode;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string | null
     */
    private $nameEn;

    /**
     * @var string | null
     */
    private $nameEs;

    /**
     * @var string | null
     */
    private $nameCa;

    /**
     * @var string | null
     */
    private $nameIt;

    /**
     * @var string
     */
    private $zoneEn = '';

    /**
     * @var string
     */
    private $zoneEs = '';

    /**
     * @var string
     */
    private $zoneCa = '';

    /**
     * @var string
     */
    private $zoneIt = '';

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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $code | null
     *
     * @return static
     */
    public function setCode(?string $code = null): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $countryCode | null
     *
     * @return static
     */
    public function setCountryCode(?string $countryCode = null): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
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
     * @param string $zoneEn | null
     *
     * @return static
     */
    public function setZoneEn(?string $zoneEn = null): self
    {
        $this->zoneEn = $zoneEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneEn(): ?string
    {
        return $this->zoneEn;
    }

    /**
     * @param string $zoneEs | null
     *
     * @return static
     */
    public function setZoneEs(?string $zoneEs = null): self
    {
        $this->zoneEs = $zoneEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneEs(): ?string
    {
        return $this->zoneEs;
    }

    /**
     * @param string $zoneCa | null
     *
     * @return static
     */
    public function setZoneCa(?string $zoneCa = null): self
    {
        $this->zoneCa = $zoneCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneCa(): ?string
    {
        return $this->zoneCa;
    }

    /**
     * @param string $zoneIt | null
     *
     * @return static
     */
    public function setZoneIt(?string $zoneIt = null): self
    {
        $this->zoneIt = $zoneIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneIt(): ?string
    {
        return $this->zoneIt;
    }

}
