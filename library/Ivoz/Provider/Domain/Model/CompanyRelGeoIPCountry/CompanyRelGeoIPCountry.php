<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry;

/**
 * CompanyRelGeoIPCountry
 */
class CompanyRelGeoIPCountry extends CompanyRelGeoIPCountryAbstract implements CompanyRelGeoIPCountryInterface
{
    use CompanyRelGeoIPCountryTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
