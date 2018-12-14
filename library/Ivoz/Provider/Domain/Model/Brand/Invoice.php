<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * @var string | null
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
        Assertion::notNull($nif, 'nif value "%s" is null, but non null value was expected.');
        Assertion::maxLength($nif, 25, 'nif value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($postalAddress, 'postalAddress value "%s" is null, but non null value was expected.');
        Assertion::maxLength($postalAddress, 255, 'postalAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($postalCode, 'postalCode value "%s" is null, but non null value was expected.');
        Assertion::maxLength($postalCode, 10, 'postalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($town, 'town value "%s" is null, but non null value was expected.');
        Assertion::maxLength($town, 255, 'town value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($province, 'province value "%s" is null, but non null value was expected.');
        Assertion::maxLength($province, 255, 'province value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($country, 'country value "%s" is null, but non null value was expected.');
        Assertion::maxLength($country, 255, 'country value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
            Assertion::maxLength($registryData, 1024, 'registryData value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->registryData = $registryData;

        return $this;
    }

    /**
     * Get registryData
     *
     * @return string | null
     */
    public function getRegistryData()
    {
        return $this->registryData;
    }

    // @codeCoverageIgnoreEnd
}
