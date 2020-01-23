<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getTz();

    /**
     * Get comment
     *
     * @return string | null
     */
    public function getComment();

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getCountry();

    /**
     * Get label
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\Label
     */
    public function getLabel();
}
