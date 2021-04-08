<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

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

    public function getTimeoutTime(): ?int;

    public function getPriority(): ?int;

    public function getRouteType(): string;

    public function getNumberValue(): ?string;

    public function setHuntGroup(?HuntGroupInterface $huntGroup = null): static;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getUser(): ?UserInterface;

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
