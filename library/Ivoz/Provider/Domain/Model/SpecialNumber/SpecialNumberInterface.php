<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface SpecialNumberInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber(): string;

    /**
     * Get numberE164
     *
     * @return string | null
     */
    public function getNumberE164();

    /**
     * Get disableCDR
     *
     * @return integer
     */
    public function getDisableCDR(): int;

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
