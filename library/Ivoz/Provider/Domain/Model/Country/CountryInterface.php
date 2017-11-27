<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CountryInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if a country uses Area code
     *
     * return true if the country has area code in its e164 pattern
     */
    public function hasAreaCode();

    /**
     * Set code
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return self
     */
    public function setCountryCode($countryCode = null);

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Country\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\Country\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Name
     */
    public function getName();

    /**
     * Set zone
     *
     * @param \Ivoz\Provider\Domain\Model\Country\Zone $zone
     *
     * @return self
     */
    public function setZone(\Ivoz\Provider\Domain\Model\Country\Zone $zone);

    /**
     * Get zone
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Zone
     */
    public function getZone();

}

