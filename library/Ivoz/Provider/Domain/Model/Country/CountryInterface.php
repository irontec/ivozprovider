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

    public function getCode(): string;

    public function getCountryCode(): ?string;

    public function getName(): Name;

    public function getZone(): Zone;

    public function isInitialized(): bool;
}
