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
     * @return array
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
    public function getId()
    {
        return $this->id;
    }
}
