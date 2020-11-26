<?php
declare(strict_types = 1);

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

    /**
     * Equals
     */
    public function equals(self $invoice)
    {
        return
            $this->getNif() === $invoice->getNif() &&
            $this->getPostalAddress() === $invoice->getPostalAddress() &&
            $this->getPostalCode() === $invoice->getPostalCode() &&
            $this->getTown() === $invoice->getTown() &&
            $this->getProvince() === $invoice->getProvince() &&
            $this->getCountry() === $invoice->getCountry() &&
            $this->getRegistryData() === $invoice->getRegistryData();
    }

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return static
     */
    protected function setNif(string $nif): Invoice
    {
        Assertion::maxLength($nif, 25, 'nif value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return static
     */
    protected function setPostalAddress(string $postalAddress): Invoice
    {
        Assertion::maxLength($postalAddress, 255, 'postalAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress(): string
    {
        return $this->postalAddress;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return static
     */
    protected function setPostalCode(string $postalCode): Invoice
    {
        Assertion::maxLength($postalCode, 10, 'postalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return static
     */
    protected function setTown(string $town): Invoice
    {
        Assertion::maxLength($town, 255, 'town value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return static
     */
    protected function setProvince(string $province): Invoice
    {
        Assertion::maxLength($province, 255, 'province value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return static
     */
    protected function setCountry(string $country): Invoice
    {
        Assertion::maxLength($country, 255, 'country value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Set registryData
     *
     * @param string $registryData | null
     *
     * @return static
     */
    protected function setRegistryData(?string $registryData = null): Invoice
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
    public function getRegistryData(): ?string
    {
        return $this->registryData;
    }

}
