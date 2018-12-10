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
    public function getLUuid();

    /**
     * Get lUsername
     *
     * @return string
     */
    public function getLUsername();

    /**
     * Get lDomain
     *
     * @return string
     */
    public function getLDomain();

    /**
     * Get rUsername
     *
     * @return string
     */
    public function getRUsername();

    /**
     * Get rDomain
     *
     * @return string
     */
    public function getRDomain();

    /**
     * Get realm
     *
     * @return string
     */
    public function getRealm();

    /**
     * Get authUsername
     *
     * @return string
     */
    public function getAuthUsername();

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword();

    /**
     * Get authProxy
     *
     * @return string
     */
    public function getAuthProxy();

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * Get regDelay
     *
     * @return integer
     */
    public function getRegDelay();

    /**
     * Get authHa1
     *
     * @return string
     */
    public function getAuthHa1();

    /**
     * Set ddiProviderRegistration
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @return self
     */
    public function setDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration);

    /**
     * Get ddiProviderRegistration
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface
     */
    public function getDdiProviderRegistration();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();
}
