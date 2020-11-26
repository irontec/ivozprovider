<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* SpecialNumberInterface
*/
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
    public function getNumberE164(): ?string;

    /**
     * Get disableCDR
     *
     * @return int
     */
    public function getDisableCDR(): int;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get country
     *
     * @return CountryInterface
     */
    public function getCountry(): CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
