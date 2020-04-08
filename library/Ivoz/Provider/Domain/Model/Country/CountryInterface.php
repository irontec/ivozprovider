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
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Get countryCode
     *
     * @return string | null
     */
    public function getCountryCode();

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Name
     */
    public function getName();

    /**
     * Get zone
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Zone
     */
    public function getZone();
}
