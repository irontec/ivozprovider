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
     * @deprecated
     * Set lUsername
     *
     * @param string $lUsername
     *
     * @return self
     */
    public function setLUsername($lUsername);

    /**
     * Get lUsername
     *
     * @return string
     */
    public function getLUsername();

    /**
     * @deprecated
     * Set lDomain
     *
     * @param string $lDomain
     *
     * @return self
     */
    public function setLDomain($lDomain);

    /**
     * Get lDomain
     *
     * @return string
     */
    public function getLDomain();

    /**
     * @deprecated
     * Set rUsername
     *
     * @param string $rUsername
     *
     * @return self
     */
    public function setRUsername($rUsername);

    /**
     * Get rUsername
     *
     * @return string
     */
    public function getRUsername();

    /**
     * @deprecated
     * Set rDomain
     *
     * @param string $rDomain
     *
     * @return self
     */
    public function setRDomain($rDomain);

    /**
     * Get rDomain
     *
     * @return string
     */
    public function getRDomain();

    /**
     * @deprecated
     * Set realm
     *
     * @param string $realm
     *
     * @return self
     */
    public function setRealm($realm);

    /**
     * Get realm
     *
     * @return string
     */
    public function getRealm();

    /**
     * @deprecated
     * Set authUsername
     *
     * @param string $authUsername
     *
     * @return self
     */
    public function setAuthUsername($authUsername);

    /**
     * Get authUsername
     *
     * @return string
     */
    public function getAuthUsername();

    /**
     * @deprecated
     * Set authPassword
     *
     * @param string $authPassword
     *
     * @return self
     */
    public function setAuthPassword($authPassword);

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
     * @deprecated
     * Set expires
     *
     * @param integer $expires
     *
     * @return self
     */
    public function setExpires($expires);

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();

    /**
     * @deprecated
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags);

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * @deprecated
     * Set regDelay
     *
     * @param integer $regDelay
     *
     * @return self
     */
    public function setRegDelay($regDelay);

    /**
     * Get regDelay
     *
     * @return integer
     */
    public function getRegDelay();

    /**
     * @deprecated
     * Set authHa1
     *
     * @param string $authHa1
     *
     * @return self
     */
    public function setAuthHa1($authHa1);

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
