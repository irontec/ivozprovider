<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;

/**
* Invoice
* @codeCoverageIgnore
*/
final class Invoice
{
    private $nif;

    private $postalAddress;

    private $postalCode;

    private $town;

    private $province;

    private $country;

    private $registryData;

    /**
     * Constructor
     */
    public function __construct(
        string $nif,
        string $postalAddress,
        string $postalCode,
        string $town,
        string $province,
        string $country,
        ?string $registryData
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
        if ($this->getNif() !== $invoice->getNif()) {
            return false;
        }
        if ($this->getPostalAddress() !== $invoice->getPostalAddress()) {
            return false;
        }
        if ($this->getPostalCode() !== $invoice->getPostalCode()) {
            return false;
        }
        if ($this->getTown() !== $invoice->getTown()) {
            return false;
        }
        if ($this->getProvince() !== $invoice->getProvince()) {
            return false;
        }
        if ($this->getCountry() !== $invoice->getCountry()) {
            return false;
        }
        return $this->getRegistryData() === $invoice->getRegistryData();
    }

    protected function setNif(string $nif): static
    {
        Assertion::maxLength($nif, 25, 'nif value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->nif = $nif;

        return $this;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    protected function setPostalAddress(string $postalAddress): static
    {
        Assertion::maxLength($postalAddress, 255, 'postalAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getPostalAddress(): string
    {
        return $this->postalAddress;
    }

    protected function setPostalCode(string $postalCode): static
    {
        Assertion::maxLength($postalCode, 10, 'postalCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    protected function setTown(string $town): static
    {
        Assertion::maxLength($town, 255, 'town value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->town = $town;

        return $this;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    protected function setProvince(string $province): static
    {
        Assertion::maxLength($province, 255, 'province value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->province = $province;

        return $this;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    protected function setCountry(string $country): static
    {
        Assertion::maxLength($country, 255, 'country value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->country = $country;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    protected function setRegistryData(?string $registryData = null): static
    {
        if (!is_null($registryData)) {
            Assertion::maxLength($registryData, 1024, 'registryData value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->registryData = $registryData;

        return $this;
    }

    public function getRegistryData(): ?string
    {
        return $this->registryData;
    }
}
