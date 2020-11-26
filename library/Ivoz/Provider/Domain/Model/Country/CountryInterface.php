<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CountryInterface
*/
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
    public function getCode(): string;

    /**
     * Get countryCode
     *
     * @return string | null
     */
    public function getCountryCode(): ?string;

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * Get zone
     *
     * @return Zone
     */
    public function getZone(): Zone;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
