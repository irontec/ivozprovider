<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Company;

use Assert\Assertion;

/**
* Invoicing
* @codeCoverageIgnore
*/
final class Invoicing
{
    /**
     * @var string
     */
    private $nif = '';

    /**
     * @var string
     */
    private $postalAddress = '';

    /**
     * @var string
     */
    private $postalCode = '';

    /**
     * @var string
     */
    private $town = '';

    /**
     * @var string
     */
    private $province = '';

    /**
     * @var string
     * column: country
     */
    private $countryName = '';

    /**
     * Constructor
     */
    public function __construct(
        string $nif = '',
        string $postalAddress = '',
        string $postalCode = '',
        string $town = '',
        string $province = '',
        string $countryName = ''
    ) {
        $this->setNif($nif);
        $this->setPostalAddress($postalAddress);
        $this->setPostalCode($postalCode);
        $this->setTown($town);
        $this->setProvince($province);
        $this->setCountryName($countryName);
    }

    public function equals(self $invoicing): bool
    {
        if ($this->getNif() !== $invoicing->getNif()) {
            return false;
        }
        if ($this->getPostalAddress() !== $invoicing->getPostalAddress()) {
            return false;
        }
        if ($this->getPostalCode() !== $invoicing->getPostalCode()) {
            return false;
        }
        if ($this->getTown() !== $invoicing->getTown()) {
            return false;
        }
        if ($this->getProvince() !== $invoicing->getProvince()) {
            return false;
        }
        return $this->getCountryName() === $invoicing->getCountryName();
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

    protected function setCountryName(string $countryName): static
    {
        Assertion::maxLength($countryName, 255, 'countryName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->countryName = $countryName;

        return $this;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }
}
