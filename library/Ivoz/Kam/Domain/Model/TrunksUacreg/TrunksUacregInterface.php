<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TrunksUacregInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setAuthProxy($authProxy);

    /**
     * @inheritdoc
     */
    public function setLUuid($lUuid);

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
     * @return integer
     */
    public function getExpires(): int;

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags(): int;

    /**
     * Get regDelay
     *
     * @return integer
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
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @return static
     */
    public function setDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration);

    /**
     * Get ddiProviderRegistration
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface
     */
    public function getDdiProviderRegistration();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
