<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;

/**
 * Invoice
 * @codeCoverageIgnore
 */
class Invoice
{
    /**
     * @var string
     */
    protected $nif;

    /**
     * @var string
     */
    protected $postalAddress;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $town;

    /**
     * @var string
     */
    protected $province;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $registryData;


    /**
     * Constructor
     */
    public function __construct(
        $nif,
        $postalAddress,
        $postalCode,
        $town,
        $province,
        $country,
        $registryData
    ) {
        $this->setNif($nif);
        $this->setPostalAddress($postalAddress);
        $this->setPostalCode($postalCode);
        $this->setTown($town);
        $this->setProvince($province);
        $this->setCountry($country);
        $this->setRegistryData($registryData);
    }

    // @codeCoverageIgnoreStart

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return self
     */
    protected function setNif($nif)
    {
        Assertion::notNull($nif);
        Assertion::maxLength($nif, 25);

        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return self
     */
    protected function setPostalAddress($postalAddress)
    {
        Assertion::notNull($postalAddress);
        Assertion::maxLength($postalAddress, 255);

        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return self
     */
    protected function setPostalCode($postalCode)
    {
        Assertion::notNull($postalCode);
        Assertion::maxLength($postalCode, 10);

        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return self
     */
    protected function setTown($town)
    {
        Assertion::notNull($town);
        Assertion::maxLength($town, 255);

        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return self
     */
    protected function setProvince($province)
    {
        Assertion::notNull($province);
        Assertion::maxLength($province, 255);

        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return self
     */
    protected function setCountry($country)
    {
        Assertion::notNull($country);
        Assertion::maxLength($country, 255);

        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set registryData
     *
     * @param string $registryData
     *
     * @return self
     */
    protected function setRegistryData($registryData = null)
    {
        if (!is_null($registryData)) {
            Assertion::maxLength($registryData, 1024);
        }

        $this->registryData = $registryData;

        return $this;
    }

    /**
     * Get registryData
     *
     * @return string
     */
    public function getRegistryData()
    {
        return $this->registryData;
    }



    // @codeCoverageIgnoreEnd
}

