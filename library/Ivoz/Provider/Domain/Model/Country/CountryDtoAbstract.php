<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CountryDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $code = '';

    /**
     * @var string
     */
    private $countryCode;

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
            'code' => 'code',
            'countryCode' => 'countryCode',
            'id' => 'id',
            'name' => ['en','es','ca','it'],
            'zone' => ['en','es','ca','it']
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
                'it' => $this->getNameIt()
            ],
            'zone' => [
                'en' => $this->getZoneEn(),
                'es' => $this->getZoneEs(),
                'ca' => $this->getZoneCa(),
                'it' => $this->getZoneIt()
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
     * @param string $code
     *
     * @return static
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $countryCode
     *
     * @return static
     */
    public function setCountryCode($countryCode = null)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCountryCode()
    {
        return $this->countryCode;
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
     * @param string $zoneEn
     *
     * @return static
     */
    public function setZoneEn($zoneEn = null)
    {
        $this->zoneEn = $zoneEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneEn()
    {
        return $this->zoneEn;
    }

    /**
     * @param string $zoneEs
     *
     * @return static
     */
    public function setZoneEs($zoneEs = null)
    {
        $this->zoneEs = $zoneEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneEs()
    {
        return $this->zoneEs;
    }

    /**
     * @param string $zoneCa
     *
     * @return static
     */
    public function setZoneCa($zoneCa = null)
    {
        $this->zoneCa = $zoneCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneCa()
    {
        return $this->zoneCa;
    }

    /**
     * @param string $zoneIt
     *
     * @return static
     */
    public function setZoneIt($zoneIt = null)
    {
        $this->zoneIt = $zoneIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getZoneIt()
    {
        return $this->zoneIt;
    }
}
