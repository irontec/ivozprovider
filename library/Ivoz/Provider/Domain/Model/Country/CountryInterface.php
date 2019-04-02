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
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Country\Name $name
     *
     * @return static
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
     * @return static
     */
    public function setZone(\Ivoz\Provider\Domain\Model\Country\Zone $zone);

    /**
     * Get zone
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Zone
     */
    public function getZone();
}
