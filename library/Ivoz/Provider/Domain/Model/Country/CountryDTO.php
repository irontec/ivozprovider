<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class CountryDTO implements DataTransferObjectInterface
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
    private $zoneEn = '';

    /**
     * @var string
     */
    private $zoneEs = '';

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'code' => $this->getCode(),
            'countryCode' => $this->getCountryCode(),
            'id' => $this->getId(),
            'nameEn' => $this->getNameEn(),
            'nameEs' => $this->getNameEs(),
            'zoneEn' => $this->getZoneEn(),
            'zoneEs' => $this->getZoneEs()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $code
     *
     * @return CountryDTO
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $countryCode
     *
     * @return CountryDTO
     */
    public function setCountryCode($countryCode = null)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param integer $id
     *
     * @return CountryDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nameEn
     *
     * @return CountryDTO
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return CountryDTO
     */
    public function setNameEs($nameEs)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $zoneEn
     *
     * @return CountryDTO
     */
    public function setZoneEn($zoneEn)
    {
        $this->zoneEn = $zoneEn;

        return $this;
    }

    /**
     * @return string
     */
    public function getZoneEn()
    {
        return $this->zoneEn;
    }

    /**
     * @param string $zoneEs
     *
     * @return CountryDTO
     */
    public function setZoneEs($zoneEs)
    {
        $this->zoneEs = $zoneEs;

        return $this;
    }

    /**
     * @return string
     */
    public function getZoneEs()
    {
        return $this->zoneEs;
    }
}


