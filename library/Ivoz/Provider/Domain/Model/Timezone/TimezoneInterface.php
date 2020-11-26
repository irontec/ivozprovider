<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TimezoneInterface
*/
interface TimezoneInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get tz
     *
     * @return string
     */
    public function getTz(): string;

    /**
     * Get comment
     *
     * @return string | null
     */
    public function getComment(): ?string;

    /**
     * Get label
     *
     * @return Label
     */
    public function getLabel(): Label;

    /**
     * Get country
     *
     * @return CountryInterface | null
     */
    public function getCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
