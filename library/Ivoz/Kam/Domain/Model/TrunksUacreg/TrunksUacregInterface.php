<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TrunksUacregInterface
*/
interface TrunksUacregInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setAuthProxy(string $authProxy): TrunksUacregInterface;

    /**
     * @inheritdoc
     */
    public function setLUuid(string $lUuid): TrunksUacregInterface;

    /**
     * Get lUuid
     *
     * @return string
     */
    public function getLUuid(): string;

    /**
     * Get lUsername
     *
     * @return string
     */
    public function getLUsername(): string;

    /**
     * Get lDomain
     *
     * @return string
     */
    public function getLDomain(): string;

    /**
     * Get rUsername
     *
     * @return string
     */
    public function getRUsername(): string;

    /**
     * Get rDomain
     *
     * @return string
     */
    public function getRDomain(): string;

    /**
     * Get realm
     *
     * @return string
     */
    public function getRealm(): string;

    /**
     * Get authUsername
     *
     * @return string
     */
    public function getAuthUsername(): string;

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword(): string;

    /**
     * Get authProxy
     *
     * @return string
     */
    public function getAuthProxy(): string;

    /**
     * Get expires
     *
     * @return int
     */
    public function getExpires(): int;

    /**
     * Get flags
     *
     * @return int
     */
    public function getFlags(): int;

    /**
     * Get regDelay
     *
     * @return int
     */
    public function getRegDelay(): int;

    /**
     * Get authHa1
     *
     * @return string
     */
    public function getAuthHa1(): string;

    /**
     * Set ddiProviderRegistration
     *
     * @param DdiProviderRegistration
     *
     * @return static
     */
    public function setDdiProviderRegistration(DdiProviderRegistration $ddiProviderRegistration): TrunksUacregInterface;

    /**
     * Get ddiProviderRegistration
     *
     * @return DdiProviderRegistration
     */
    public function getDdiProviderRegistration(): DdiProviderRegistration;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
