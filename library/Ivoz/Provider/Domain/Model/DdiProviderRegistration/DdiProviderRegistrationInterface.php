<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface DdiProviderRegistrationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain);

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
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
     * Set authProxy
     *
     * @param string $authProxy
     *
     * @return self
     */
    public function setAuthProxy($authProxy);

    /**
     * Get authProxy
     *
     * @return string
     */
    public function getAuthProxy();

    /**
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
     * Set multiDdi
     *
     * @param boolean $multiDdi
     *
     * @return self
     */
    public function setMultiDdi($multiDdi = null);

    /**
     * Get multiDdi
     *
     * @return boolean
     */
    public function getMultiDdi();

    /**
     * Set contactUsername
     *
     * @param string $contactUsername
     *
     * @return self
     */
    public function setContactUsername($contactUsername);

    /**
     * Get contactUsername
     *
     * @return string
     */
    public function getContactUsername();

    /**
     * Set trunksUacreg
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface $trunksUacreg
     *
     * @return self
     */
    public function setTrunksUacreg(\Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface $trunksUacreg = null);

    /**
     * Get trunksUacreg
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface
     */
    public function getTrunksUacreg();

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider
     *
     * @return self
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null);

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface
     */
    public function getDdiProvider();

}

