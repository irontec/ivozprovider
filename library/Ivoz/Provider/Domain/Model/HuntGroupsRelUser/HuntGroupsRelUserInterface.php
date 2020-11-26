<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* HuntGroupsRelUserInterface
*/
interface HuntGroupsRelUserInterface extends LoggableEntityInterface
{
    const ROUTETYPE_NUMBER = 'number';

    const ROUTETYPE_USER = 'user';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    /**
     * Get timeoutTime
     *
     * @return int | null
     */
    public function getTimeoutTime(): ?int;

    /**
     * Get priority
     *
     * @return int | null
     */
    public function getPriority(): ?int;

    /**
     * Get routeType
     *
     * @return string
     */
    public function getRouteType(): string;

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue(): ?string;

    /**
     * Set huntGroup
     *
     * @param HuntGroupInterface | null
     *
     * @return static
     */
    public function setHuntGroup(?HuntGroupInterface $huntGroup = null): HuntGroupsRelUserInterface;

    /**
     * Get huntGroup
     *
     * @return HuntGroupInterface | null
     */
    public function getHuntGroup(): ?HuntGroupInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

    /**
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
