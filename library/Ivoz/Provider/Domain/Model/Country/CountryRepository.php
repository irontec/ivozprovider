<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CountryRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $countryCode
     * @param string|null $code
     * @return CountryInterface|null
     */
    public function findOneByCountryCode(string $countryCode, string $code = null);

    /**
     * @param string $code
     * @return CountryInterface|null
     */
    public function findOneByCode(string $code);
}
