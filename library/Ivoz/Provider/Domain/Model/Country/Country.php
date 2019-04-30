<?php

namespace Ivoz\Provider\Domain\Model\Country;

/**
 * Country
 */
class Country extends CountryAbstract implements CountryInterface
{
    use CountryTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
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
