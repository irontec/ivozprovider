<?php

namespace Ivoz\Provider\Domain\Model\Country;

/**
 * Country
 */
class Country extends CountryAbstract implements CountryInterface
{
    use CountryTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Check if a country uses Area code
     *
     * return true if the country has area code in its e164 pattern
     */
    public function hasAreaCode()
    {
        return strpos($this->getE164Pattern(), 'ac') !== FALSE;
    }
}

