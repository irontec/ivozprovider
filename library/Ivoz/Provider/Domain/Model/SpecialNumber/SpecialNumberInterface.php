<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* SpecialNumberInterface
*/
interface SpecialNumberInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getNumber(): string;

    public function getNumberE164(): ?string;

    public function getDisableCDR(): int;

    public function getBrand(): ?BrandInterface;

    public function getCountry(): CountryInterface;

    public function isInitialized(): bool;
}
